===source===
<?php
class A {
    #[X(parent::class)]
    function m() {}
}
===errors >=8.0===
Cannot use "parent" when current class scope has no parent
===php_error >=8.0===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 4
===ast <=7.4===
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
                      "start": 53,
                      "end": 54
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
===ast >=8.0===
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
                      "start": 53,
                      "end": 54
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "X"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 23
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
                                          "start": 24,
                                          "end": 30
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 24,
                                      "end": 30
                                    }
                                  },
                                  "member": {
                                    "kind": {
                                      "Identifier": "class"
                                    },
                                    "span": {
                                      "start": 32,
                                      "end": 37
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 24,
                                "end": 37
                              }
                            }
                          },
                          "span": {
                            "start": 24,
                            "end": 37
                          }
                        }
                      ],
                      "span": {
                        "start": 22,
                        "end": 38
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
