<?php
helper::import('F:\xampp\htdocs\pms\module\user\model.php');
class extuserModel extends userModel 
{
public function batchCreate()
    {
        $users    = fixer::input('post')->get(); 
        $data     = array();
        $accounts = array();
        for($i = 0; $i < $this->config->user->batchCreate; $i++)
        {
            if($users->account[$i] != '')  
            {
                $account = $this->dao->select('account')->from(TABLE_USER)->where('account')->eq($users->account[$i])->fetch();
                if($account) die(js::error(sprintf($this->lang->user->error->accountDupl, $i+1)));
                if(in_array($users->account[$i], $accounts)) die(js::error(sprintf($this->lang->user->error->accountDupl, $i+1)));
                if(!validater::checkAccount($users->account[$i])) die(js::error(sprintf($this->lang->user->error->account, $i+1)));
                if($users->realname[$i] == '') die(js::error(sprintf($this->lang->user->error->realname, $i+1)));
                if($users->email[$i] and !validater::checkEmail($users->email[$i])) die(js::error(sprintf($this->lang->user->error->mail, $i+1)));
                $users->password[$i] = (isset($prev['password']) and $users->ditto[$i] == 'on' and empty($users->password[$i])) ? $prev['password'] : $users->password[$i];
                if(!validater::checkReg($users->password[$i], '|(.){6,}|')) die(js::error(sprintf($this->lang->user->error->password, $i+1)));
                $role = $users->role[$i] == 'ditto' ? (isset($prev['role']) ? $prev['role'] : '') : $users->role[$i];

                $data[$i] = new stdclass();
                $data[$i]->dept             = $users->dept[$i] == 'ditto' ? (isset($prev['dept']) ? $prev['dept'] : 0) : $users->dept[$i];
                $data[$i]->work_id          = $users->work_id[$i];
                $data[$i]->account          = $users->account[$i];
                $data[$i]->realname         = $users->realname[$i];
                $data[$i]->role             = $role;
                $data[$i]->group            = $users->group[$i] == 'ditto' ? (isset($prev['group']) ? $prev['group'] : '') : $users->group[$i];
                $data[$i]->higher_up        = $users->higher_up[$i] == 'ditto' ? (isset($prev['higher_up']) ? $prev['higher_up'] : '') : $users->higher_up[$i];
                $data[$i]->identify         = $users->identify[$i] == 'ditto' ? (isset($prev['identify']) ? $prev['identify'] : '') : $users->identify[$i];
                $data[$i]->department_group = $users->department_group[$i];
                $data[$i]->email            = $users->email[$i];
                $data[$i]->gender           = $users->gender[$i];
                $data[$i]->password         = md5($users->password[$i]); 

                $accounts[$i]      = $data[$i]->account;
                $prev['dept']      = $data[$i]->dept;
                $prev['role']      = $data[$i]->role;
                $prev['group']     = $data[$i]->group;
                $prev['higher_up'] = $data[$i]->higher_up;
                $prev['identify']  = $data[$i]->identify;
                $prev['password']  = $users->password[$i];
            }
        }

        foreach($data as $user)
        {
            if($user->group)
            {
                $group = new stdClass();
                $group->account = $user->account;
                $group->group   = $user->group;
                $this->dao->insert(TABLE_USERGROUP)->data($group)->exec();
            }
            unset($user->group);
            $this->dao->insert(TABLE_USER)->data($user)->autoCheck()->check('work_id', 'unique')->exec();
            if(dao::isError()) 
            {
                echo js::error(dao::getError());
                die(js::reload('parent'));
            }
        }
    }
public function batchEdit()
    {
        $oldUsers     = $this->dao->select('id, account')->from(TABLE_USER)->where('id')->in(array_keys($this->post->account))->fetchPairs('id', 'account');
        $accountGroup = $this->dao->select('id, account')->from(TABLE_USER)->where('account')->in($this->post->account)->fetchGroup('account', 'id');

        $accounts = array();
        foreach($this->post->account as $id => $account)
        {
            $users[$id]['account']          = $account;
            $users[$id]['realname']         = $this->post->realname[$id];
            $users[$id]['work_id']          = $this->post->work_id[$id];
            $users[$id]['email']            = $this->post->email[$id];
            $users[$id]['join']             = $this->post->join[$id];
            $users[$id]['higher_up']        = $this->post->higher_up[$id];
            $users[$id]['department_group'] = $this->post->department_group[$id];
            $users[$id]['dept']             = $this->post->dept[$id] == 'ditto' ? (isset($prev['dept']) ? $prev['dept'] : 0) : $this->post->dept[$id];
            $users[$id]['role']             = $this->post->role[$id] == 'ditto' ? (isset($prev['role']) ? $prev['role'] : 0) : $this->post->role[$id];
            $users[$id]['identify']         = $this->post->identify[$id] == 'ditto' ? (isset($prev['identify']) ? $prev['identify'] : 0) : $this->post->identify[$id];

            if(isset($accountGroup[$account]) and count($accountGroup[$account]) > 1) die(js::error(sprintf($this->lang->user->error->accountDupl, $id)));
            if(in_array($account, $accounts)) die(js::error(sprintf($this->lang->user->error->accountDupl, $id)));
            if(!validater::checkAccount($users[$id]['account'])) die(js::error(sprintf($this->lang->user->error->account, $id)));
            if($users[$id]['realname'] == '') die(js::error(sprintf($this->lang->user->error->realname, $id)));
            if($users[$id]['email'] and !validater::checkEmail($users[$id]['email'])) die(js::error(sprintf($this->lang->user->error->mail, $id)));
            //if(empty($users[$id]['role'])) die(js::error(sprintf($this->lang->user->error->role, $id)));

            $accounts[$id]     = $account;
            $prev['dept']      = $users[$id]['dept'];
            $prev['role']      = $users[$id]['role'];
            $prev['identify']  = $users[$id]['identify'];
        }

        foreach($users as $id => $user)
        {
            $this->dao->update(TABLE_USER)->data($user)->where('id')->eq((int)$id)->exec();
            if($user['account'] != $oldUsers[$id])
            {
                $oldAccount = $oldUsers[$id];
                $this->dao->update(TABLE_USERGROUP)->set('account')->eq($user['account'])->where('account')->eq($oldAccount)->exec();
                if(strpos($this->app->company->admins, ',' . $oldAccount . ',') !== false)
                {
                    $admins = str_replace(',' . $oldAccount . ',', ',' . $user['account'] . ',', $this->app->company->admins);
                    $this->dao->update(TABLE_COMPANY)->set('admins')->eq($admins)->where('id')->eq($this->app->company->id)->exec();
                }
                if(!dao::isError() and $this->app->user->account == $oldAccount) $this->app->user->account = $users['account'];
            }
        }
    }
public function createEntryinf($user_id,$path)
    {
        $entryinf = fixer::input('post')
                ->setDefault('user_id', $user_id)
                ->get(); 
        if($path){
            foreach($path as $k=>$v){
                $entryinf->$k = $v;
            }
        }
        $this->dao->insert(TABLE_STAFFENTRY)
                ->data($entryinf)
                ->check('user_id','unique')
                ->batchCheck($this->config->my->createentry->requiredFields,'notempty')
                ->exec();
    }
public function getEnrtyinf($user_id)
    {
       $entryinf = $this->dao->select('*')->from(TABLE_STAFFENTRY)
                ->where('user_id')->eq($user_id)
                ->fetch();
       return $entryinf ? $entryinf : false;
    }
public function updateEntryinf($user_id, $path)
    {
        $entryinf = fixer::input('post')
                ->get();
        //die(print(js::alert(json_encode($user_id))));
        if($path){
            $oldentryinf = $this->getEnrtyinf($user_id);           
            foreach($path as $k=>$v){
                $entryinf->$k = $v;
                unlink($this->app->getAppRoot() . $this->lang->uploadDir . $oldentryinf->$k);
            }
        }
        $this->dao->update(TABLE_STAFFENTRY)
                ->data($entryinf)
                ->batchCheck($this->config->my->createentry->requiredFields,'notempty')        
                ->where('user_id')->eq((int)$user_id)
                ->exec();
    }
//**//
}