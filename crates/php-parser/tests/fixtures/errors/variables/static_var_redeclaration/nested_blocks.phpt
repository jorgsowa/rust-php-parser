===source===
<?php
function f() {
    if (true) {
        static $c;
    }
    while (true) {
        static $c;
    }
}
===errors >=8.3===
Duplicate declaration of static variable $c
===php_error >=8.3===
PHP Fatal error:  Duplicate declaration of static variable $c in Standard input code on line 7
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "If": {
                  "condition": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 29,
                      "end": 33
                    }
                  },
                  "then_branch": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "StaticVar": [
                              {
                                "name": {
                                  "name": "c",
                                  "span": {
                                    "start": 52,
                                    "end": 54
                                  }
                                },
                                "default": null,
                                "span": {
                                  "start": 52,
                                  "end": 54
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 45,
                            "end": 55
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 35,
                      "end": 61
                    }
                  },
                  "elseif_branches": [],
                  "else_branch": null
                }
              },
              "span": {
                "start": 25,
                "end": 61
              }
            },
            {
              "kind": {
                "While": {
                  "condition": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 73,
                      "end": 77
                    }
                  },
                  "body": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "StaticVar": [
                              {
                                "name": {
                                  "name": "c",
                                  "span": {
                                    "start": 96,
                                    "end": 98
                                  }
                                },
                                "default": null,
                                "span": {
                                  "start": 96,
                                  "end": 98
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 89,
                            "end": 99
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 79,
                      "end": 105
                    }
                  }
                }
              },
              "span": {
                "start": 66,
                "end": 105
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
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
