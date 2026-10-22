===source===
<?php
class A {
    function a(): namespace\static {}
    function b(): ?\static {}
    function c(): namespace\self {}
    function d() { return new namespace\static; }
}
function f(): \static {}
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'\static' is an invalid class name
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'\static' is an invalid class name
===errors 8.0-8.4===
'\static' is an invalid class name
'\static' is an invalid class name
===errors >=8.5===
Type declaration 'static' must be unqualified
Type declaration 'static' must be unqualified
Type declaration 'static' must be unqualified
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC), expecting identifier (T_STRING) in Standard input code on line 3
===php_error 8.0-8.4===
PHP Fatal error:  '\static' is an invalid class name in Standard input code on line 4
===php_error >=8.5===
PHP Fatal error:  Type declaration 'static' must be unqualified in Standard input code on line 3
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
                    "name": "a",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Relative",
                        "span": {
                          "start": 34,
                          "end": 50
                        }
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 50
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 53
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 67,
                      "end": 68
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "static"
                            ],
                            "kind": "FullyQualified",
                            "span": {
                              "start": 73,
                              "end": 80
                            }
                          }
                        },
                        "span": {
                          "start": 73,
                          "end": 80
                        }
                      }
                    },
                    "span": {
                      "start": 72,
                      "end": 80
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 58,
                "end": 83
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 97,
                      "end": 98
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Relative",
                        "span": {
                          "start": 102,
                          "end": 116
                        }
                      }
                    },
                    "span": {
                      "start": 102,
                      "end": 116
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 88,
                "end": 119
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 133,
                      "end": 134
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
                                  "Name": {
                                    "parts": [
                                      "static"
                                    ],
                                    "kind": "Relative",
                                    "span": {
                                      "start": 150,
                                      "end": 166
                                    }
                                  }
                                },
                                "span": {
                                  "start": 150,
                                  "end": 166
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 146,
                            "end": 166
                          }
                        }
                      },
                      "span": {
                        "start": 139,
                        "end": 167
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 124,
                "end": 169
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 171
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 181,
              "end": 182
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "static"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 186,
                  "end": 193
                }
              }
            },
            "span": {
              "start": 186,
              "end": 193
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 172,
        "end": 196
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 196
  }
}
