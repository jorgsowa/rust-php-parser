===source===
<?php
enum E {
    public function f(): void { return 1; }
    public function &g($a) { return $a?->b; }
}
===errors===
A void function must not return a value
Cannot take reference of a nullsafe chain
===php_error===
PHP Fatal error:  A void method must not return a value in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                          "start": 40,
                          "end": 44
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 44
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 54,
                            "end": 55
                          }
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 56
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 58
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 80,
                      "end": 81
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": true,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 82,
                          "end": 84
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
                        "start": 82,
                        "end": 84
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "NullsafePropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 95,
                                  "end": 97
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 100,
                                  "end": 101
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 95,
                            "end": 101
                          }
                        }
                      },
                      "span": {
                        "start": 88,
                        "end": 102
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 63,
                "end": 104
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 106
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 106
  }
}
