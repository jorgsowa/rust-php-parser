===source===
<?php
function f($x, ...$v) {}
f(v: $a[]);
f(...$y, x: $a[]);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'named argument after argument unpacking' requires PHP 8.1 or higher
===errors 8.0===
'named argument after argument unpacking' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 3
===php_error 8.0===
PHP Fatal error:  Cannot combine named arguments and argument unpacking in Standard input code on line 4
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
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 19
              }
            },
            {
              "name": {
                "name": "v",
                "span": {
                  "start": 24,
                  "end": 26
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 21,
                "end": 26
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 31,
                      "end": 32
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 32
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "v"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 33,
                      "end": 34
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 36,
                              "end": 38
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 40
                      }
                    }
                  },
                  "span": {
                    "start": 33,
                    "end": 40
                  }
                }
              ]
            }
          },
          "span": {
            "start": 31,
            "end": 41
          }
        }
      },
      "span": {
        "start": 31,
        "end": 42
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 43,
                      "end": 44
                    }
                  }
                },
                "span": {
                  "start": 43,
                  "end": 44
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "y"
                      },
                      "span": {
                        "start": 48,
                        "end": 50
                      }
                    }
                  },
                  "span": {
                    "start": 45,
                    "end": 50
                  }
                },
                {
                  "name": {
                    "parts": [
                      "x"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 52,
                      "end": 53
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 55,
                              "end": 57
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 55,
                        "end": 59
                      }
                    }
                  },
                  "span": {
                    "start": 52,
                    "end": 59
                  }
                }
              ]
            }
          },
          "span": {
            "start": 43,
            "end": 60
          }
        }
      },
      "span": {
        "start": 43,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
