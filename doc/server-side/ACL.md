ACL API Module
---

## ACL::**moveDown**
Move a ACL down the list (order). HTTP Only.

* **URL**: https://www.x4b.net/apiv2/ACL/moveDown
* **URL Params**: 

    **acl_type** - should be http

    **query[id]** - int: ID of the ACL object

    **query[mask]** - string: Mask (CIDR) of the ACL object

    **query[type]** - string: Type (allow/deny) of the ACL object. acl_type HTTP Only

    **query[order]** - int: Numerical order value (optional)

    **query[fw]** - int: The firewall profile ID linked to

* **Returns**: 
```
{
    "id": "int: ID of the ACL object",
    "mask": "string: Mask (CIDR) of the ACL object",
    "type": "string: Type (allow\/deny) of the ACL object. acl_type HTTP Only",
    "order": "int: Numerical order value (optional)",
    "fw": "int: The firewall profile ID linked to"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## ACL::**moveUp**
Move a ACL up the list (order). HTTP Only.

* **URL**: https://www.x4b.net/apiv2/ACL/moveUp
* **URL Params**: 

    **acl_type** - should be http

    **query[id]** - int: ID of the ACL object

    **query[mask]** - string: Mask (CIDR) of the ACL object

    **query[type]** - string: Type (allow/deny) of the ACL object. acl_type HTTP Only

    **query[order]** - int: Numerical order value (optional)

    **query[fw]** - int: The firewall profile ID linked to

* **Returns**: 
```
{
    "id": "int: ID of the ACL object",
    "mask": "string: Mask (CIDR) of the ACL object",
    "type": "string: Type (allow\/deny) of the ACL object. acl_type HTTP Only",
    "order": "int: Numerical order value (optional)",
    "fw": "int: The firewall profile ID linked to"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## ACL::**bulk**
method not documented

## ACL::**insert**
Synonym for Create

* **URL**: https://www.x4b.net/apiv2/ACL/insert
* **URL Params**: see create
* **Returns**: see create
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## ACL::**create**
Create a new ACL object

* **URL**: https://www.x4b.net/apiv2/ACL/create
* **URL Params**: 

    **value[mask]** - string: Mask (CIDR) of the ACL object

    **value[type]** - string: Type (allow/deny) of the ACL object. acl_type HTTP Only

    **value[order]** - int: Numerical order value (optional)

    **value[fw]** - int: The firewall profile ID linked to

    **acl_type** - string: The type of ACL, either droplist (TCP/UDP/etc) or http (HTTP/HTTPS). Not required if a port is specified in either value or query.

* **Returns**: 
```
{
    "status": "ok"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## ACL::**get**
Get the value of a ACL object matching a query

* **URL**: https://www.x4b.net/apiv2/ACL/get
* **URL Params**: 

    **query[id]** - int: ID of the ACL object

    **query[mask]** - string: Mask (CIDR) of the ACL object

    **query[type]** - string: Type (allow/deny) of the ACL object. acl_type HTTP Only

    **query[order]** - int: Numerical order value (optional)

    **query[fw]** - int: The firewall profile ID linked to

    **acl_type** - string: The type of ACL, either droplist (TCP/UDP/etc) or http (HTTP/HTTPS). Not required if a port is specified in either value or query.

* **Returns**: 
```
{
    "id": "int: ID of the ACL object",
    "mask": "string: Mask (CIDR) of the ACL object",
    "type": "string: Type (allow\/deny) of the ACL object. acl_type HTTP Only",
    "order": "int: Numerical order value (optional)",
    "fw": "int: The firewall profile ID linked to"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## ACL::**update**
Change the values in a ACL object

* **URL**: https://www.x4b.net/apiv2/ACL/update
* **URL Params**: 

    **query[id]** - int: ID of the ACL object

    **query[mask]** - string: Mask (CIDR) of the ACL object

    **query[type]** - string: Type (allow/deny) of the ACL object. acl_type HTTP Only

    **query[order]** - int: Numerical order value (optional)

    **query[fw]** - int: The firewall profile ID linked to

    **value[mask]** - string: Mask (CIDR) of the ACL object

    **value[type]** - string: Type (allow/deny) of the ACL object. acl_type HTTP Only

    **value[order]** - int: Numerical order value (optional)

    **value[fw]** - int: The firewall profile ID linked to

    **acl_type** - string: The type of ACL, either droplist (TCP/UDP/etc) or http (HTTP/HTTPS). Not required if a port is specified in either value or query.

* **Returns**: 
```
{
    "id": "int: ID of the ACL object",
    "mask": "string: Mask (CIDR) of the ACL object",
    "type": "string: Type (allow\/deny) of the ACL object. acl_type HTTP Only",
    "order": "int: Numerical order value (optional)",
    "fw": "int: The firewall profile ID linked to"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## ACL::**delete**
Delete a ACL object matching a query

* **URL**: https://www.x4b.net/apiv2/ACL/delete
* **URL Params**: 

    **query[id]** - int: ID of the ACL object

    **query[mask]** - string: Mask (CIDR) of the ACL object

    **query[type]** - string: Type (allow/deny) of the ACL object. acl_type HTTP Only

    **query[order]** - int: Numerical order value (optional)

    **query[fw]** - int: The firewall profile ID linked to

    **acl_type** - string: The type of ACL, either droplist (TCP/UDP/etc) or http (HTTP/HTTPS). Not required if a port is specified in either value or query.

* **Returns**: 
```
{
    "status": "ok"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## ACL::**all**
Get the value of a ACL objects matching a query

* **URL**: https://www.x4b.net/apiv2/ACL/all
* **URL Params**: 

    **query[id]** - int: ID of the ACL object

    **query[mask]** - string: Mask (CIDR) of the ACL object

    **query[type]** - string: Type (allow/deny) of the ACL object. acl_type HTTP Only

    **query[order]** - int: Numerical order value (optional)

    **query[fw]** - int: The firewall profile ID linked to

    **page** - optional structure with "start" and "limit" members to page the output

    **acl_type** - string: The type of ACL, either droplist (TCP/UDP/etc) or http (HTTP/HTTPS). Not required if a port is specified in either value or query.

* **Returns**: 
```
[
    {
        "id": "int: ID of the ACL object",
        "mask": "string: Mask (CIDR) of the ACL object",
        "type": "string: Type (allow\/deny) of the ACL object. acl_type HTTP Only",
        "order": "int: Numerical order value (optional)",
        "fw": "int: The firewall profile ID linked to"
    }
]
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## ACL::**describe**
Provides any available description for the ACL API module

* **URL**: https://www.x4b.net/apiv2/ACL/describe
* **URL Params**: 

    **acl_type** - string: The type of ACL, either droplist (TCP/UDP/etc) or http (HTTP/HTTPS). Not required if a port is specified in either value or query.

* **Returns**: this
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
