The permission 'access block library' comes from
BlockContentAccessControlHandler::checkCreateAccess()
in core/modules/block_content/src/BlockContentAccessControlHandler.php.

That’s why _entity_create_any_access:block_content ends up depending on the Access Block Library permission.