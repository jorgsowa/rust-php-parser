===description===
PHP stops at the first violation; every independent violation of one method is reported.
===source===
<?php
class A {
    private static function __get(int $n): int {}
    function __set(&$n, $v, $w): int {}
    function __destruct(&$a): void {}
}
===errors===
Method A::__get() cannot be static
The magic method A::__get() must have public visibility
A::__get(): Parameter #1 ($n) must be of type string when declared
Method A::__set() must take exactly 2 arguments
A::__set(): Return type must be void when declared
Method A::__destruct() cannot take arguments
Method A::__destruct() cannot declare a return type
===php_error===
PHP Fatal error:  Method A::__get() cannot be static in Standard input code on line 3
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
                    "name": "__get",
                    "span": {
                      "start": 44,
                      "end": 49
                    }
                  },
                  "visibility": "Private",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 54,
                          "end": 56
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
                              "start": 50,
                              "end": 53
                            }
                          }
                        },
                        "span": {
                          "start": 50,
                          "end": 53
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 56
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
                          "start": 59,
                          "end": 62
                        }
                      }
                    },
                    "span": {
                      "start": 59,
                      "end": 62
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 65
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set",
                    "span": {
                      "start": 79,
                      "end": 84
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 86,
                          "end": 88
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 85,
                        "end": 88
                      }
                    },
                    {
                      "name": {
                        "name": "v",
                        "span": {
                          "start": 90,
                          "end": 92
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 90,
                        "end": 92
                      }
                    },
                    {
                      "name": {
                        "name": "w",
                        "span": {
                          "start": 94,
                          "end": 96
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 94,
                        "end": 96
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
                          "start": 99,
                          "end": 102
                        }
                      }
                    },
                    "span": {
                      "start": 99,
                      "end": 102
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 70,
                "end": 105
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__destruct",
                    "span": {
                      "start": 119,
                      "end": 129
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 131,
                          "end": 133
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 130,
                        "end": 133
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 136,
                          "end": 140
                        }
                      }
                    },
                    "span": {
                      "start": 136,
                      "end": 140
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 110,
                "end": 143
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 145
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 145
  }
}
