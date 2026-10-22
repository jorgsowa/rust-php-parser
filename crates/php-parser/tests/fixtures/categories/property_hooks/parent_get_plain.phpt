===source===
<?php

class P {
    public $prop = 42;
}

class C extends P {
    public $prop = 42 {
        get => parent::$prop::get();
    }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 8
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 8
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "P",
            "span": {
              "start": 13,
              "end": 14
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
                    "name": "prop",
                    "span": {
                      "start": 28,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 38
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 41
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 49,
              "end": 50
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "P"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 59,
              "end": 60
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 74,
                      "end": 79
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 82,
                      "end": 84
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 102,
                                            "end": 108
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 102,
                                        "end": 108
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "prop"
                                      },
                                      "span": {
                                        "start": 110,
                                        "end": 115
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 102,
                                  "end": 115
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 117,
                                  "end": 120
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 102,
                            "end": 122
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 95,
                        "end": 123
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 67,
                "end": 129
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 43,
        "end": 131
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 131
  }
}
