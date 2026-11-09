===source===
<?php
class A extends B {
    function m() {
        parent::${'a'}::set(1);
    }
}
===errors >=8.4===
Must not use parent::$a::set() outside a property hook
===php_error >=8.4===
PHP Fatal error:  Must not use parent::$a::set() outside a property hook in Standard input code on line 4
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
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "StaticPropertyAccessDynamic": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 53,
                                            "end": 59
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 53,
                                        "end": 59
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "VariableVariable": {
                                          "kind": {
                                            "String": "a"
                                          },
                                          "span": {
                                            "start": 63,
                                            "end": 66
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 61,
                                        "end": 67
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 53,
                                  "end": 67
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "set"
                                },
                                "span": {
                                  "start": 69,
                                  "end": 72
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 73,
                                        "end": 74
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 73,
                                    "end": 74
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 53,
                            "end": 75
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 76
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 82
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 84
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 84
  }
}
