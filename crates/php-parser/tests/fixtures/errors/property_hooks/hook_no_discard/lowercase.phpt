===source===
<?php
namespace N;
class A {
    public $b { #[\nodiscard] get => 1; }
}
===errors <=7.4===
'property hooks' requires PHP 8.4 or higher
Property hook list must not be empty
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
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 25,
              "end": 26
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
                    "name": "b",
                    "span": {
                      "start": 40,
                      "end": 42
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
                "start": 33,
                "end": 72
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
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
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 25,
              "end": 26
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
                    "name": "b",
                    "span": {
                      "start": 40,
                      "end": 42
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
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 66,
                            "end": 67
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "nodiscard"
                            ],
                            "kind": "FullyQualified",
                            "span": {
                              "start": 47,
                              "end": 57
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 47,
                            "end": 57
                          }
                        }
                      ],
                      "span": {
                        "start": 45,
                        "end": 68
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 33,
                "end": 70
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}
