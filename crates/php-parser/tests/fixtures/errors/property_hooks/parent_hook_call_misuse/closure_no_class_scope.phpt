===source===
<?php
$f = function () { return parent::$a::set(1); };
===errors >=8.4===
Cannot use "parent" when no class scope is active
===php_error >=8.4===
PHP Fatal error:  Cannot use "parent" when no class scope is active in Standard input code on line 2
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
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Return": {
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
                                              "start": 32,
                                              "end": 38
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 32,
                                          "end": 38
                                        }
                                      },
                                      "member": {
                                        "kind": {
                                          "Identifier": "a"
                                        },
                                        "span": {
                                          "start": 40,
                                          "end": 42
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 32,
                                    "end": 42
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "set"
                                  },
                                  "span": {
                                    "start": 44,
                                    "end": 47
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
                                          "start": 48,
                                          "end": 49
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 48,
                                      "end": 49
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 32,
                              "end": 50
                            }
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 51
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 53
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 53
          }
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
