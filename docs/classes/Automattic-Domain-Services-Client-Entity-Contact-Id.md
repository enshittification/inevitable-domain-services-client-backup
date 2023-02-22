# Class: [\Automattic](../namespaces/automattic.md)[\Domain_Services_Client](../namespaces/automattic-domain-services-client.md)[\Entity](../namespaces/automattic-domain-services-client-entity.md)\Contact_Id

## Summary:

Represents a contact ID

## Description:

- Contact IDs are generated by creating new contacts after submitting `Contact_Information`
- `Domain_Contact` can be either represented as a contact ID or as contact information, but not both.


---

### Methods

* public [__construct()](#method___construct)
* public [get_contact_id()](#method_get_contact_id)

---

### Details

* File: [lib/entity/contact-id.php](../../lib/entity/contact-id.php)
* See Also:
  * [\Automattic\Domain_Services_Client\Entity\Domain_Contact](../classes/Automattic-Domain-Services-Client-Entity-Domain-Contact.md)

---

## Methods

<a id="method___construct"></a>
### __construct

```
public __construct(string  contact_id) : mixed
```

##### Summary

Constructs a `Contact_Id` entity

##### Parameters:

| Name | Type | Default |
|------|------|---------|
| **$contact_id** | string |  |

##### Throws:

| Type | Description |
|------|-------------|
| \Automattic\Domain_Services_Client\Exception\Entity\Invalid_Value_Exception |  |

##### Returns:

```
mixed
```

---

<a id="method_get_contact_id"></a>
### get_contact_id

```
public get_contact_id() : string
```

##### Summary

Returns the contact ID

##### Returns:

```
string
```