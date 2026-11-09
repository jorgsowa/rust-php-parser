===source===
<?php
class A extends B {
    function m() {
        parent::$a::get();
    }
}
===errors >=8.4===
Must not use parent::$a::get() outside a property hook
===php_error >=8.4===
PHP Fatal error:  Must not use parent::$a::get() outside a property hook in Standard input code on line 4
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
                                  "StaticPropertyAccess": {
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
                                        "Identifier": "a"
                                      },
                                      "span": {
                                        "start": 61,
                                        "end": 63
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 53,
                                  "end": 63
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 65,
                                  "end": 68
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 53,
                            "end": 70
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 71
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
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
