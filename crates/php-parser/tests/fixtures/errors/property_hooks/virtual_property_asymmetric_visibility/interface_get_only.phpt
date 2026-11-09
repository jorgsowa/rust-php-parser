===source===
<?php
interface I {
    public private(set) int $a { get; }
}
===errors <=8.3===
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
get-only virtual property I::$a must not specify asymmetric visibility
===errors >=8.4===
get-only virtual property I::$a must not specify asymmetric visibility
===php_error <=8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
===php_error 8.4-8.5===
PHP Fatal error:  Read-only virtual property I::$a must not specify asymmetric visibility in Standard input code on line 3
===php_error >=8.6===
PHP Fatal error:  get-only virtual property I::$a must not specify asymmetric visibility in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 48,
                      "end": 50
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 44,
                          "end": 47
                        }
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 47
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 53,
                        "end": 57
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 24,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
