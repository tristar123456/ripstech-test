<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170629145114 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $table = $schema->createTable("users");
        $table->addColumn("id","integer")->getAutoincrement();
        $table->setPrimaryKey(array("id"));
        $table->addColumn("username","string");
        $table->addColumn("password", "string");
        $table->addColumn("is_active","boolean");
        $table->addColumn("roles","array");


    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
       $schema->dropTable("users");

    }
}
