===source===
<?php
class A {
    function m() {
        return new class(parent::X) {};
    }
}
===errors >=8.0===
Cannot use "parent" when current class scope has no parent
===php_error >=8.0===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 4
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
                    "name": "m",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "AnonymousClass": {
                                    "name": null,
                                    "modifiers": {
                                      "is_abstract": false,
                                      "is_final": false,
                                      "is_readonly": false
                                    },
                                    "extends": null,
                                    "implements": [],
                                    "members": [],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 50,
                                  "end": 73
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "ClassConstAccess": {
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
                                          "member": {
                                            "kind": {
                                              "Identifier": "X"
                                            },
                                            "span": {
                                              "start": 68,
                                              "end": 69
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 60,
                                        "end": 69
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 60,
                                    "end": 69
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 50,
                            "end": 73
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 74
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 80
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
  }
}
