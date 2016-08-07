<?php

use Phinx\Migration\AbstractMigration;

class PagesEntityOperator extends AbstractMigration
{
    public function up()
    {
        //id table 11
        $table = $this->table("pages");
        $table->rename("pages_old");
        $table->save();

        $sql = <<<SQL
CREATE TABLE pages
(
-- Унаследована from table named:  id bigint NOT NULL,
-- Унаследована from table named:  created timestamp without time zone,
-- Унаследована from table named:  changed timestamp without time zone,
-- Унаследована from table named:  active boolean DEFAULT true,
-- Унаследована from table named:  title text,
-- Унаследована from table named:  description text,
  url text,
  CONSTRAINT pages2_pkey PRIMARY KEY (id),
  CONSTRAINT pages2_url_key UNIQUE (url)
)
INHERITS (content);
SQL;
        $this->execute($sql);


        $table = $this->table("pages");
        $table->addColumn("old_id", "integer", ['null' => true]);
        $table->save();

        $sql = "CREATE SEQUENCE uuid_complex_short_tables_11";
        $this->execute($sql);

        $sql = "insert into pages (id, created, changed, active, title, description, content, url, old_id) select  uuid_short_complex_tables(11), created, changed, true, title, description, \"text\", \"name\", id from pages_old";

        $this->execute($sql);
    }
}
