Zone API Module
---

## Zone::**moveDown**
method not documented

## Zone::**moveUp**
method not documented

## Zone::**bulk**
method not documented

## Zone::**insert**
Synonym for Create

* **URL**: https://www.x4b.net/apiv2/Zone/insert
* **URL Params**: see create
* **Returns**: see create
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Zone::**create**
Create a new Zone object

* **URL**: https://www.x4b.net/apiv2/Zone/create
* **URL Params**: 

    **value[port]** - string: the port this zone belongs to

    **value[expr]** - string: the match expression

    **value[insensitive]** - string: match insensitively (yes/no)

    **value[mode]** - string: the cache mode (safe/yes/no/force/fallback)

    **value[order]** - int: the numerical order

    **value[status]** - string: comma seperated list of HTTP statuses to cache

    **value[expires]** - int: number of seconds to expire cache hits

    **value[req_cachecontrol]** - not documented

    **value[key_host]** - not documented

    **value[key_query]** - not documented

    **value[key_case_sensitive]** - not documented

    **value[send_expires]** - not documented

    **value[redirect]** - string: url to redirect to

    **value[redirect_who]** - not documented

    **value[ratelimit]** - not documented

    **value[ratelimit_burst]** - not documented

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
## Zone::**get**
Get the value of a Zone object matching a query

* **URL**: https://www.x4b.net/apiv2/Zone/get
* **URL Params**: 

    **query[id]** - int: ID of the Zone object

    **query[port]** - string: the port this zone belongs to

    **query[expr]** - string: the match expression

    **query[insensitive]** - string: match insensitively (yes/no)

    **query[mode]** - string: the cache mode (safe/yes/no/force/fallback)

    **query[order]** - int: the numerical order

    **query[status]** - string: comma seperated list of HTTP statuses to cache

    **query[expires]** - int: number of seconds to expire cache hits

    **query[req_cachecontrol]** - not documented

    **query[key_host]** - not documented

    **query[key_query]** - not documented

    **query[key_case_sensitive]** - not documented

    **query[send_expires]** - not documented

    **query[redirect]** - string: url to redirect to

    **query[redirect_who]** - not documented

    **query[ratelimit]** - not documented

    **query[ratelimit_burst]** - not documented

* **Returns**: 
```
{
    "id": "int: ID of the Zone object",
    "port": "string: the port this zone belongs to",
    "expr": "string: the match expression",
    "insensitive": "string: match insensitively (yes\/no)",
    "mode": "string: the cache mode (safe\/yes\/no\/force\/fallback)",
    "order": "int: the numerical order",
    "status": "string: comma seperated list of HTTP statuses to cache",
    "expires": "int: number of seconds to expire cache hits",
    "req_cachecontrol": "not documented",
    "key_host": "not documented",
    "key_query": "not documented",
    "key_case_sensitive": "not documented",
    "send_expires": "not documented",
    "redirect": "string: url to redirect to",
    "redirect_who": "not documented",
    "ratelimit": "not documented",
    "ratelimit_burst": "not documented"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Zone::**update**
Change the values in a Zone object

* **URL**: https://www.x4b.net/apiv2/Zone/update
* **URL Params**: 

    **query[id]** - int: ID of the Zone object

    **query[port]** - string: the port this zone belongs to

    **query[expr]** - string: the match expression

    **query[insensitive]** - string: match insensitively (yes/no)

    **query[mode]** - string: the cache mode (safe/yes/no/force/fallback)

    **query[order]** - int: the numerical order

    **query[status]** - string: comma seperated list of HTTP statuses to cache

    **query[expires]** - int: number of seconds to expire cache hits

    **query[req_cachecontrol]** - not documented

    **query[key_host]** - not documented

    **query[key_query]** - not documented

    **query[key_case_sensitive]** - not documented

    **query[send_expires]** - not documented

    **query[redirect]** - string: url to redirect to

    **query[redirect_who]** - not documented

    **query[ratelimit]** - not documented

    **query[ratelimit_burst]** - not documented

    **value[port]** - string: the port this zone belongs to

    **value[expr]** - string: the match expression

    **value[insensitive]** - string: match insensitively (yes/no)

    **value[mode]** - string: the cache mode (safe/yes/no/force/fallback)

    **value[order]** - int: the numerical order

    **value[status]** - string: comma seperated list of HTTP statuses to cache

    **value[expires]** - int: number of seconds to expire cache hits

    **value[req_cachecontrol]** - not documented

    **value[key_host]** - not documented

    **value[key_query]** - not documented

    **value[key_case_sensitive]** - not documented

    **value[send_expires]** - not documented

    **value[redirect]** - string: url to redirect to

    **value[redirect_who]** - not documented

    **value[ratelimit]** - not documented

    **value[ratelimit_burst]** - not documented

* **Returns**: 
```
{
    "id": "int: ID of the Zone object",
    "port": "string: the port this zone belongs to",
    "expr": "string: the match expression",
    "insensitive": "string: match insensitively (yes\/no)",
    "mode": "string: the cache mode (safe\/yes\/no\/force\/fallback)",
    "order": "int: the numerical order",
    "status": "string: comma seperated list of HTTP statuses to cache",
    "expires": "int: number of seconds to expire cache hits",
    "req_cachecontrol": "not documented",
    "key_host": "not documented",
    "key_query": "not documented",
    "key_case_sensitive": "not documented",
    "send_expires": "not documented",
    "redirect": "string: url to redirect to",
    "redirect_who": "not documented",
    "ratelimit": "not documented",
    "ratelimit_burst": "not documented"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Zone::**delete**
Delete a Zone object matching a query

* **URL**: https://www.x4b.net/apiv2/Zone/delete
* **URL Params**: 

    **query[id]** - int: ID of the Zone object

    **query[port]** - string: the port this zone belongs to

    **query[expr]** - string: the match expression

    **query[insensitive]** - string: match insensitively (yes/no)

    **query[mode]** - string: the cache mode (safe/yes/no/force/fallback)

    **query[order]** - int: the numerical order

    **query[status]** - string: comma seperated list of HTTP statuses to cache

    **query[expires]** - int: number of seconds to expire cache hits

    **query[req_cachecontrol]** - not documented

    **query[key_host]** - not documented

    **query[key_query]** - not documented

    **query[key_case_sensitive]** - not documented

    **query[send_expires]** - not documented

    **query[redirect]** - string: url to redirect to

    **query[redirect_who]** - not documented

    **query[ratelimit]** - not documented

    **query[ratelimit_burst]** - not documented

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
## Zone::**all**
Get the value of a Zone objects matching a query

* **URL**: https://www.x4b.net/apiv2/Zone/all
* **URL Params**: 

    **query[id]** - int: ID of the Zone object

    **query[port]** - string: the port this zone belongs to

    **query[expr]** - string: the match expression

    **query[insensitive]** - string: match insensitively (yes/no)

    **query[mode]** - string: the cache mode (safe/yes/no/force/fallback)

    **query[order]** - int: the numerical order

    **query[status]** - string: comma seperated list of HTTP statuses to cache

    **query[expires]** - int: number of seconds to expire cache hits

    **query[req_cachecontrol]** - not documented

    **query[key_host]** - not documented

    **query[key_query]** - not documented

    **query[key_case_sensitive]** - not documented

    **query[send_expires]** - not documented

    **query[redirect]** - string: url to redirect to

    **query[redirect_who]** - not documented

    **query[ratelimit]** - not documented

    **query[ratelimit_burst]** - not documented

    **page** - optional structure with "start" and "limit" members to page the output

* **Returns**: 
```
[
    {
        "id": "int: ID of the Zone object",
        "port": "string: the port this zone belongs to",
        "expr": "string: the match expression",
        "insensitive": "string: match insensitively (yes\/no)",
        "mode": "string: the cache mode (safe\/yes\/no\/force\/fallback)",
        "order": "int: the numerical order",
        "status": "string: comma seperated list of HTTP statuses to cache",
        "expires": "int: number of seconds to expire cache hits",
        "req_cachecontrol": "not documented",
        "key_host": "not documented",
        "key_query": "not documented",
        "key_case_sensitive": "not documented",
        "send_expires": "not documented",
        "redirect": "string: url to redirect to",
        "redirect_who": "not documented",
        "ratelimit": "not documented",
        "ratelimit_burst": "not documented"
    }
]
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Zone::**describe**
Provides any available description for the Zone API module

* **URL**: https://www.x4b.net/apiv2/Zone/describe
* **URL Params**: 

* **Returns**: this
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
