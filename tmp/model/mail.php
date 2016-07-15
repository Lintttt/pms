<?php
helper::import('F:\xampp\htdocs\pms\module\mail\model.php');
class extmailModel extends mailModel 
{
public function send($toList, $subject, $body = '', $ccList = '', $includeMe = false,$addattachmentpath='',$addattachmentpath2='',$to_extends='',$cc_extends='')
    {
        if(!$this->config->mail->turnon) return;

        ob_start();
        $toList  = $toList ? explode(',', str_replace(' ', '', $toList)) : array();
        $ccList  = $ccList ? explode(',', str_replace(' ', '', $ccList)) : array();

        /* Process toList and ccList, remove current user from them. If toList is empty, use the first cc as to. */
        if($includeMe == false)
        {
            $account = isset($this->app->user->account) ? $this->app->user->account : '';

            foreach($toList as $key => $to) if(trim($to) == $account or !trim($to)) unset($toList[$key]);
            foreach($ccList as $key => $cc) if(trim($cc) == $account or !trim($cc)) unset($ccList[$key]);
        }

        /* Remove deleted users. */
        $users = $this->loadModel('user')->getPairs('nodeleted');
        foreach($toList as $key => $to) if(!isset($users[trim($to)])) unset($toList[$key]);
        foreach($ccList as $key => $cc) if(!isset($users[trim($cc)])) unset($ccList[$key]);

        if(!$toList and !$ccList) return;
        if(!$toList and $ccList) $toList = array(array_shift($ccList));
        $toList = join(',', $toList);
        $ccList = join(',', $ccList);

        /* Get realname and email of users. */
        $this->loadModel('user');
        $emails = $this->user->getRealNameAndEmails(str_replace(' ', '', $toList . ',' . $ccList));
        
        $this->clear();

        /* Replace full webPath image for mail. */
        if(strpos($body, 'src="data/upload')) $body = preg_replace('/<img (.*)src="data\/upload/', '<img $1 src="http://' . $this->server->http_host . $this->config->webRoot . 'data/upload', $body);

        try 
        {
            $this->mta->setFrom($this->config->mail->fromAddress, $this->convertCharset($this->config->mail->fromName));
            $this->setSubject($this->convertCharset($subject));
            $this->setTO($toList, $emails);
            $this->setCC($ccList, $emails);
            
            //抄送
            $emailCCExtends = explode(',',$cc_extends);
            foreach($emailCCExtends as $v){
            	if($v)
               $this->mta->addCC($v,'');
            }
            
            $this->setBody($this->convertCharset($body));
            $this->setErrorLang();
            
            //附件
            if($addattachmentpath !='')$this->mta->AddAttachment("$addattachmentpath");
            if($addattachmentpath2 !='')$this->mta->AddAttachment("$addattachmentpath2");            
            
            //发送
            $emailToExtends = explode(',',$to_extends);
            foreach($emailToExtends as $v){
            	if($v)
               $this->mta->addAddress($v,'');
            }
            
            $this->mta->send();
        }
        catch (phpmailerException $e) 
        {
            $this->errors[] = nl2br(trim(strip_tags($e->errorMessage()))) . '<br />' . ob_get_contents();
        } 
        catch (Exception $e) 
        {
            $this->errors[] = trim(strip_tags($e->getMessage()));
        }

        /* save errors. */
        if($this->isError()) $this->app->saveError('E_MAIL', join(' ', $this->errors), __FILE__, __LINE__, true);

        $message = ob_get_contents();
        ob_clean();

        return $message;
    }
//**//
}