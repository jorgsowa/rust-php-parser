===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A extends B { function f() { parent::$a::get(); } }
===errors >=8.4===
Must not use parent::$a::get() outside a property hook
===php_error >=8.4===
PHP Fatal error:  Must not use parent::$a::get() outside a property hook in Standard input code on line 1
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
                    "name": "f",
                    "span": {
                      "start": 35,
                      "end": 36
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
                                            "start": 41,
                                            "end": 47
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 41,
                                        "end": 47
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "a"
                                      },
                                      "span": {
                                        "start": 49,
                                        "end": 51
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 41,
                                  "end": 51
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 53,
                                  "end": 56
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 41,
                            "end": 58
                          }
                        }
                      },
                      "span": {
                        "start": 41,
                        "end": 59
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 26,
                "end": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
