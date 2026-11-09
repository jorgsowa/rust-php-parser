===source===
<?php
class A {
    protected private(set) int $d { set => $value; get => 1; }
}
===errors <=8.3===
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
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
                    "name": "d",
                    "span": {
                      "start": 47,
                      "end": 49
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
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
                          "start": 43,
                          "end": 46
                        }
                      }
                    },
                    "span": {
                      "start": 43,
                      "end": 46
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Variable": "value"
                          },
                          "span": {
                            "start": 59,
                            "end": 65
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 52,
                        "end": 66
                      }
                    },
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 74,
                            "end": 75
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 67,
                        "end": 76
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 78
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 80
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80
  }
}
