===source===
<?php
class A {
    function f(parent $p): parent {
        parent::f();
        return new parent;
    }
}
===errors >=8.0===
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
===php_error >=8.0===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 3
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
                    "name": "f",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "p",
                        "span": {
                          "start": 38,
                          "end": 40
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "parent"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 31,
                              "end": 37
                            }
                          }
                        },
                        "span": {
                          "start": 31,
                          "end": 37
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 31,
                        "end": 40
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 43,
                          "end": 49
                        }
                      }
                    },
                    "span": {
                      "start": 43,
                      "end": 49
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 60,
                                      "end": 66
                                    }
                                  }
                                },
                                "span": {
                                  "start": 60,
                                  "end": 66
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "f"
                                },
                                "span": {
                                  "start": 68,
                                  "end": 69
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 60,
                            "end": 71
                          }
                        }
                      },
                      "span": {
                        "start": 60,
                        "end": 72
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 92,
                                      "end": 98
                                    }
                                  }
                                },
                                "span": {
                                  "start": 92,
                                  "end": 98
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 88,
                            "end": 98
                          }
                        }
                      },
                      "span": {
                        "start": 81,
                        "end": 99
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 105
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 107
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 107
  }
}
