# Class: [\Automattic](../namespaces/automattic.md)[\Domain_Services_Client](../namespaces/automattic-domain-services-client.md)[\Command](../namespaces/automattic-domain-services-client-command.md)[\Domain](../namespaces/automattic-domain-services-client-command-domain.md)[\Set](../namespaces/automattic-domain-services-client-command-domain-set.md)\Contacts

## Summary:

Updates domain contacts

## Description:

- This command updates any or all of a domain's contacts.
- Contact types not included in the request would not be updated, but won't be deleted.
- For each contact type, either a contact ID or the full contact information can be provided.
- If contact information is provided, a new contact will be created and the contact ID will be returned.
- This command runs asynchronously on the server.
- Getting a success response means that the operation was queued successfully.
- A domain has four contact types: owner, admin, tech and billing

## Example:
```
$domain_name = new Entity\Domain_Name( 'example.com' );
$contact_id = new Entity\Contact_Id( 'SP1:5499554' );
$domain_contacts = new Entity\Domain_Contacts();

$domain_contacts->set_owner( new Entity\Domain_Contact( $contact_id ) );
$domain_contacts->set_billing( new Entity\Domain_Contact( $contact_id ) );

$command = new Command\Domain\Set\Contacts( $domain_name, $domain_contacts );

$response = $api->post( $command );
if ( $response->is_success() ) {
    // The update request was queued successfully
}
```


---

### Methods

* public [__construct()](#method___construct)

---

### Details

* File: [lib/command/domain/set/contacts.php](../../lib/command/domain/set/contacts.php)
* Implements:
  * [\Automattic\Domain_Services_Client\Command\Command_Interface](../classes/Automattic-Domain-Services-Client-Command-Command-Interface.md)
* See Also:
  * [\Automattic\Domain_Services_Client\Response\Domain\Set\Contacts](../classes/Automattic-Domain-Services-Client-Response-Domain-Set-Contacts.md)
  * [\Automattic\Domain_Services_Client\Entity\Contact_Id](../classes/Automattic-Domain-Services-Client-Entity-Contact-Id.md)
  * [\Automattic\Domain_Services_Client\Entity\Contact_Information](../classes/Automattic-Domain-Services-Client-Entity-Contact-Information.md)
  * [\Automattic\Domain_Services_Client\Entity\Domain_Contacts](../classes/Automattic-Domain-Services-Client-Entity-Domain-Contacts.md)
  * [\Automattic\Domain_Services_Client\Entity\Domain_Contact](../classes/Automattic-Domain-Services-Client-Entity-Domain-Contact.md)

---

## Methods

<a id="method___construct"></a>
### __construct

```
public __construct(\Automattic\Domain_Services_Client\Entity\Domain_Name  domain, \Automattic\Domain_Services_Client\Entity\Domain_Contacts  contacts) : mixed
```

##### Summary

Constructs a `Domain\Set\Contacts` command

##### Parameters:

| Name | Type | Default |
|------|------|---------|
| **$domain** | \Automattic\Domain_Services_Client\Entity\Domain_Name |  |
| **$contacts** | \Automattic\Domain_Services_Client\Entity\Domain_Contacts |  |

##### Throws:

| Type | Description |
|------|-------------|
| \Automattic\Domain_Services_Client\Exception\Entity\Invalid_Value_Exception |  |

##### Returns:

```
mixed
```