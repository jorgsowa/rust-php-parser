===source===
<?php
if ((void) f()) {}
echo (void) f();
for (; (void) f();) {}
foreach ((void) $a as $b) {}
function g() { return (void) f(); }
===errors <=8.4===
'void cast' requires PHP 8.5 or higher
'void cast' requires PHP 8.5 or higher
'void cast' requires PHP 8.5 or higher
'void cast' requires PHP 8.5 or higher
'void cast' requires PHP 8.5 or higher
(void) cast cannot be used in an expression context
(void) cast cannot be used in an expression context
(void) cast cannot be used in an expression context
(void) cast cannot be used in an expression context
(void) cast cannot be used in an expression context
===errors >=8.5===
(void) cast cannot be used in an expression context
(void) cast cannot be used in an expression context
(void) cast cannot be used in an expression context
(void) cast cannot be used in an expression context
(void) cast cannot be used in an expression context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'f' (T_STRING) in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected identifier "f" in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "(void)" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Cast": [
                "Void",
                {
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
                              "start": 17,
                              "end": 18
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 18
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 20
                  }
                }
              ]
            },
            "span": {
              "start": 10,
              "end": 20
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 22,
              "end": 24
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Cast": [
                "Void",
                {
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
                              "start": 37,
                              "end": 38
                            }
                          }
                        },
                        "span": {
                          "start": 37,
                          "end": 38
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 37,
                    "end": 40
                  }
                }
              ]
            },
            "span": {
              "start": 30,
              "end": 40
            }
          }
        ]
      },
      "span": {
        "start": 25,
        "end": 41
      }
    },
    {
      "kind": {
        "For": {
          "init": [],
          "condition": [
            {
              "kind": {
                "Cast": [
                  "Void",
                  {
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
                                "start": 56,
                                "end": 57
                              }
                            }
                          },
                          "span": {
                            "start": 56,
                            "end": 57
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 59
                    }
                  }
                ]
              },
              "span": {
                "start": 49,
                "end": 59
              }
            }
          ],
          "update": [],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 62,
              "end": 64
            }
          }
        }
      },
      "span": {
        "start": 42,
        "end": 64
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Cast": [
                "Void",
                {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 81,
                    "end": 83
                  }
                }
              ]
            },
            "span": {
              "start": 74,
              "end": 83
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 87,
              "end": 89
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 91,
              "end": 93
            }
          }
        }
      },
      "span": {
        "start": 65,
        "end": 93
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 103,
              "end": 104
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Cast": [
                      "Void",
                      {
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
                                    "start": 123,
                                    "end": 124
                                  }
                                }
                              },
                              "span": {
                                "start": 123,
                                "end": 124
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 123,
                          "end": 126
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 116,
                    "end": 126
                  }
                }
              },
              "span": {
                "start": 109,
                "end": 127
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 94,
        "end": 129
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 129
  }
}
