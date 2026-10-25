===source===
<?php
class A {
    function __get(&$n) {}
    function __set($n, &$v) {}
    function __call(string &$n, array $a) {}
    static function __set_state(array &$a) {}
}
===errors <=7.4===
Method A::__get() cannot take arguments by reference
Method A::__set() cannot take arguments by reference
Method A::__call() cannot take arguments by reference
===errors >=8.0===
Method A::__get() cannot take arguments by reference
Method A::__set() cannot take arguments by reference
Method A::__call() cannot take arguments by reference
Method A::__set_state() cannot take arguments by reference
===php_error===
PHP Fatal error:  Method A::__get() cannot take arguments by reference in Standard input code on line 3
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
                      "start": 29,
                      "end": 34
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 36,
                          "end": 38
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 35,
                        "end": 38
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
                "end": 42
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set",
                    "span": {
                      "start": 56,
                      "end": 61
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 62,
                          "end": 64
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 62,
                        "end": 64
                      }
                    },
                    {
                      "name": {
                        "name": "v",
                        "span": {
                          "start": 67,
                          "end": 69
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 66,
                        "end": 69
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 73
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__call",
                    "span": {
                      "start": 87,
                      "end": 93
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 102,
                          "end": 104
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
                              "start": 94,
                              "end": 100
                            }
                          }
                        },
                        "span": {
                          "start": 94,
                          "end": 100
                        }
                      },
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 94,
                        "end": 104
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 112,
                          "end": 114
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 106,
                              "end": 111
                            }
                          }
                        },
                        "span": {
                          "start": 106,
                          "end": 111
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 106,
                        "end": 114
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 78,
                "end": 118
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set_state",
                    "span": {
                      "start": 139,
                      "end": 150
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 158,
                          "end": 160
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 151,
                              "end": 156
                            }
                          }
                        },
                        "span": {
                          "start": 151,
                          "end": 156
                        }
                      },
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 151,
                        "end": 160
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 123,
                "end": 164
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 166
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 166
  }
}
