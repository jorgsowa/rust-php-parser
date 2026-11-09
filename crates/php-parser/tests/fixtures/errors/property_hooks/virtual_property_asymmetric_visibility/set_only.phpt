===source===
<?php
class A {
    public protected(set) int $c { set { } }
}
===errors <=8.3===
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
set-only virtual property A::$c must not specify asymmetric visibility
===errors >=8.4===
set-only virtual property A::$c must not specify asymmetric visibility
===php_error <=8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
===php_error 8.4-8.5===
PHP Fatal error:  Write-only virtual property A::$c must not specify asymmetric visibility in Standard input code on line 3
===php_error >=8.6===
PHP Fatal error:  set-only virtual property A::$c must not specify asymmetric visibility in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 46,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Protected"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 42,
                          "end": 45
                        }
                      }
                    },
                    "span": {
                      "start": 42,
                      "end": 45
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 51,
                        "end": 58
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
