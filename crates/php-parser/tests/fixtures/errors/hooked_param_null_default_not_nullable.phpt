===source===
<?php
class P {
    public function __construct(int $z = null { get => $this->z; }) {}
}
===errors <=7.4===
'property hooks' requires PHP 8.4 or higher
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
Cannot use null as default value for parameter $z of type int
===errors >=8.4===
Cannot use null as default value for parameter $z of type int
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ')' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "=>" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use null as default value for parameter $z of type int in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "P",
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 36,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "z",
                        "span": {
                          "start": 52,
                          "end": 54
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 48,
                              "end": 51
                            }
                          }
                        },
                        "span": {
                          "start": 48,
                          "end": 51
                        }
                      },
                      "default": {
                        "kind": "Null",
                        "span": {
                          "start": 57,
                          "end": 61
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "PropertyAccess": {
                                  "object": {
                                    "kind": {
                                      "Variable": "this"
                                    },
                                    "span": {
                                      "start": 71,
                                      "end": 76
                                    }
                                  },
                                  "property": {
                                    "kind": {
                                      "Identifier": "z"
                                    },
                                    "span": {
                                      "start": 78,
                                      "end": 79
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 71,
                                "end": 79
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 64,
                            "end": 80
                          }
                        }
                      ],
                      "span": {
                        "start": 48,
                        "end": 82
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 86
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 88
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 88
  }
}
