===source===
<?php
class C { abstract public string $p { get; set; } abstract public $q { get; } }
===errors===
Class C contains 3 abstract methods and must therefore be declared abstract or implement the remaining methods (C::$p::get, C::$p::set, C::$q::get)
===php_error <=8.1===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error 8.2===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error 8.3===
PHP Fatal error:  Cannot use the abstract modifier on a property in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Class C contains 3 abstract methods and must therefore be declared abstract or implement the remaining methods (C::$p::get, C::$p::set, C::$q::get) in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "p",
                    "span": {
                      "start": 39,
                      "end": 41
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 32,
                          "end": 38
                        }
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 38
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
                        "start": 44,
                        "end": 48
                      }
                    },
                    {
                      "kind": "Set",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 49,
                        "end": 53
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 55
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "q",
                    "span": {
                      "start": 72,
                      "end": 74
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": null,
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
                        "start": 77,
                        "end": 81
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 56,
                "end": 83
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 85
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 85
  }
}
