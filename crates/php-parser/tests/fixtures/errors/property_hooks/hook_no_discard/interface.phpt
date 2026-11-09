===source===
<?php
namespace N;
interface I {
    public $a { #[\NoDiscard] get; }
}
===errors <=7.4===
'property hooks' requires PHP 8.4 or higher
Property hook list must not be empty
Interfaces may not include properties
missing closing '}'
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
===errors >=8.5===
#[\NoDiscard] is not supported for property hooks
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 4
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 4
===php_error >=8.5===
PHP Fatal error:  #[\NoDiscard] is not supported for property hooks in Standard input code on line 4
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 29,
              "end": 30
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
                      "start": 44,
                      "end": 46
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "empty_hook_list": true
                }
              },
              "span": {
                "start": 37,
                "end": 71
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 29,
              "end": 30
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
                      "start": 44,
                      "end": 46
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "FullyQualified",
                            "span": {
                              "start": 51,
                              "end": 61
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 51,
                            "end": 61
                          }
                        }
                      ],
                      "span": {
                        "start": 49,
                        "end": 67
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 37,
                "end": 69
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
