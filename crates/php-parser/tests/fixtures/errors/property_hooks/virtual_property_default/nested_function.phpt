===source===
<?php
class A {
    public $n = 1 { get { function n() { return $this->n; } return 1; } }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property A::$n
===errors >=8.4===
Cannot specify default value for virtual hooked property A::$n
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot specify default value for virtual hooked property A::$n in Standard input code on line 3
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
                    "name": "n",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 32,
                      "end": 33
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Function": {
                                "name": {
                                  "name": "n",
                                  "span": {
                                    "start": 51,
                                    "end": 52
                                  }
                                },
                                "params": [],
                                "body": [
                                  {
                                    "kind": {
                                      "Return": {
                                        "kind": {
                                          "PropertyAccess": {
                                            "object": {
                                              "kind": {
                                                "Variable": "this"
                                              },
                                              "span": {
                                                "start": 64,
                                                "end": 69
                                              }
                                            },
                                            "property": {
                                              "kind": {
                                                "Identifier": "n"
                                              },
                                              "span": {
                                                "start": 71,
                                                "end": 72
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 64,
                                          "end": 72
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 57,
                                      "end": 73
                                    }
                                  }
                                ],
                                "return_type": null,
                                "by_ref": false,
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 42,
                              "end": 75
                            }
                          },
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 83,
                                  "end": 84
                                }
                              }
                            },
                            "span": {
                              "start": 76,
                              "end": 85
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 87
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 89
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}
