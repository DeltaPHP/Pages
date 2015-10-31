<?php

use Phinx\Migration\AbstractMigration;

class PagesInitPg extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
        $sql = <<<SQL
CREATE TABLE pages
(
   id serial,
   name text,
   description text,
   text text,
   title text,
   created timestamp with time zone,
   changed timestamp with time zone,
   PRIMARY KEY (id),
   UNIQUE (name)
);
SQL;
        $this->execute($sql);
    }


    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
