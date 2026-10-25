===source===
<?php
class A {
    static function __construct() {}
    function __destruct($a) {}
    function __clone(): void {}
    function __get(int $name): int {}
    function __set($a, &$b) {}
    function __toString($a) {}
}
===errors <=7.4===
Constructor A::__construct() cannot be static
Destructor A::__destruct() cannot take arguments
Clone method A::__clone() cannot declare a return type
Method A::__set() cannot take arguments by reference
Method A::__tostring() cannot take arguments
===errors >=8.0===
Method A::__construct() cannot be static
Method A::__destruct() cannot take arguments
A::__get(): Parameter #1 ($name) must be of type string when declared
Method A::__set() cannot take arguments by reference
Method A::__toString() cannot take arguments
===php_error <=7.4===
PHP Fatal error:  Destructor A::__destruct() cannot take arguments in Standard input code on line 4
===php_error >=8.0===
PHP Fatal error:  Method A::__construct() cannot be static in Standard input code on line 3
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 36,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 52
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__destruct",
                    "span": {
                      "start": 66,
                      "end": 76
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 77,
                          "end": 79
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 77,
                        "end": 79
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 57,
                "end": 83
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__clone",
                    "span": {
                      "start": 97,
                      "end": 104
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 108,
                          "end": 112
                        }
                      }
                    },
                    "span": {
                      "start": 108,
                      "end": 112
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 88,
                "end": 115
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__get",
                    "span": {
                      "start": 129,
                      "end": 134
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "name",
                        "span": {
                          "start": 139,
                          "end": 144
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
                              "start": 135,
                              "end": 138
                            }
                          }
                        },
                        "span": {
                          "start": 135,
                          "end": 138
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 135,
                        "end": 144
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 147,
                          "end": 150
                        }
                      }
                    },
                    "span": {
                      "start": 147,
                      "end": 150
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 120,
                "end": 153
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set",
                    "span": {
                      "start": 167,
                      "end": 172
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 173,
                          "end": 175
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 173,
                        "end": 175
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 178,
                          "end": 180
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 177,
                        "end": 180
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 158,
                "end": 184
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__toString",
                    "span": {
                      "start": 198,
                      "end": 208
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 209,
                          "end": 211
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 209,
                        "end": 211
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 189,
                "end": 215
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 217
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 217
  }
}
