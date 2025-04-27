<?php

namespace App\Models;

use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Model;

class m_contact extends Model
{
    function ajoutContact($infoContact){

        // connexion à la base
        $db=db_connect();
        try {
            $db->table('contact_messages')
                ->insert($infoContact);
            return $db->affectedRows();
        } catch (DatabaseException $e) {
            $errorCode = $e->getCode();
            return $errorCode;
        }
    }
}