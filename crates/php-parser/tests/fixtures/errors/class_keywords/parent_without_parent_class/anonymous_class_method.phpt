===source===
<?php
$o = new class {
    function n() { return parent::Y; }
};
===errors >=8.0===
Cannot use "parent" when current class scope has no parent
===php_error >=8.0===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
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
                          "members": [
                            {
                              "kind": {
                                "Method": {
                                  "name": {
                                    "name": "n",
                                    "span": {
                                      "start": 36,
                                      "end": 37
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
                                            "ClassConstAccess": {
                                              "class": {
                                                "kind": {
                                                  "Name": {
                                                    "parts": [
                                                      "parent"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 49,
                                                      "end": 55
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 49,
                                                  "end": 55
                                                }
                                              },
                                              "member": {
                                                "kind": {
                                                  "Identifier": "Y"
                                                },
                                                "span": {
                                                  "start": 57,
                                                  "end": 58
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 49,
                                            "end": 58
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 42,
                                        "end": 59
                                      }
                                    }
                                  ],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 27,
                                "end": 61
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 63
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 63
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 63
          }
        }
      },
      "span": {
        "start": 6,
        "end": 64
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64
  }
}
