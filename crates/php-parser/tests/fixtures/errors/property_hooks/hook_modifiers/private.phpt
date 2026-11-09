===source===
<?php
class A {
    public $c { private set { $this->c = $value; } }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot use the private modifier on a property hook
===errors >=8.4===
Cannot use the private modifier on a property hook
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use the private modifier on a property hook in Standard input code on line 3
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
                      "start": 27,
                      "end": 29
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
                      "kind": "Set",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Assign": {
                                    "target": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 46,
                                              "end": 51
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "c"
                                            },
                                            "span": {
                                              "start": 53,
                                              "end": 54
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 46,
                                        "end": 54
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 57,
                                        "end": 63
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 46,
                                  "end": 63
                                }
                              }
                            },
                            "span": {
                              "start": 46,
                              "end": 64
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 66
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 68
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
