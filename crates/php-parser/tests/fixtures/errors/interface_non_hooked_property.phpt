===config===
min_php=8.4
===description===
PHP 8.4 introduced hooked properties in interfaces. A plain (non-hooked)
property declaration in an interface is rejected with "Interfaces may
only include hooked properties".
===source===
<?php
interface I {
    public int $x;
}
===errors===
Interfaces may only include hooked properties
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "I",
          "extends": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": "x",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 31,
                          "end": 34
                        }
                      }
                    },
                    "span": {
                      "start": 31,
                      "end": 34
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 37
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
===php_error===
PHP Fatal error:  Interfaces may only include hooked properties in Standard input code on line 3
