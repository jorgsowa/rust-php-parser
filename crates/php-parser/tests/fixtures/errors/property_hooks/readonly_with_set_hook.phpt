===source===
<?php
class Foo {
    public readonly string $bar {
        set(string $value) { $this->bar = $value; }
    }
}
===errors <=8.0===
'readonly properties' requires PHP 8.1 or higher
'property hooks' requires PHP 8.4 or higher
Hooked properties cannot be readonly
===errors 8.1-8.3===
'property hooks' requires PHP 8.4 or higher
Hooked properties cannot be readonly
===errors >=8.4===
Hooked properties cannot be readonly
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'string' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "string", expecting variable in Standard input code on line 3
===php_error 8.1-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Hooked properties cannot be readonly in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                    "name": "bar",
                    "span": {
                      "start": 45,
                      "end": 49
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 38,
                          "end": 44
                        }
                      }
                    },
                    "span": {
                      "start": 38,
                      "end": 44
                    }
                  },
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
                                              "start": 81,
                                              "end": 86
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "bar"
                                            },
                                            "span": {
                                              "start": 88,
                                              "end": 91
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 81,
                                        "end": 91
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 94,
                                        "end": 100
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 81,
                                  "end": 100
                                }
                              }
                            },
                            "span": {
                              "start": 81,
                              "end": 101
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "value",
                            "span": {
                              "start": 71,
                              "end": 77
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "string"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 64,
                                  "end": 70
                                }
                              }
                            },
                            "span": {
                              "start": 64,
                              "end": 70
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 64,
                            "end": 77
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 60,
                        "end": 103
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 109
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 111
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 111
  }
}
