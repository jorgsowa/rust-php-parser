===source===
<?php
class A {
    const C = 1;
    public function m($a = self::C ?? $x) {}
}
===errors===
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 4
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
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 53,
                      "end": 54
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 55,
                          "end": 57
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "NullCoalesce": {
                            "left": {
                              "kind": {
                                "ClassConstAccess": {
                                  "class": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "self"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 60,
                                          "end": 64
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 60,
                                      "end": 64
                                    }
                                  },
                                  "member": {
                                    "kind": {
                                      "Identifier": "C"
                                    },
                                    "span": {
                                      "start": 66,
                                      "end": 67
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 60,
                                "end": 67
                              }
                            },
                            "right": {
                              "kind": {
                                "Variable": "x"
                              },
                              "span": {
                                "start": 71,
                                "end": 73
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 60,
                          "end": 73
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 55,
                        "end": 73
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 37,
                "end": 77
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 79
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79
  }
}
