<?php

namespace Sprint\Migration;


class agent20230902203553 extends Version
{
    protected $description = "";

    protected $moduleVersion = "4.3.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Agent()->saveAgent(array (
  'MODULE_ID' => '',
  'USER_ID' => NULL,
  'SORT' => '0',
  'NAME' => 'deletePeople();',
  'ACTIVE' => 'Y',
  'NEXT_EXEC' => '02.09.2023 20:26:41',
  'AGENT_INTERVAL' => '86400',
  'IS_PERIOD' => 'N',
  'RETRY_COUNT' => '0',
));
    }

    public function down()
    {
        //your code ...
    }
}