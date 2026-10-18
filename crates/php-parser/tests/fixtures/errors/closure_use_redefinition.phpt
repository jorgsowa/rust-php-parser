===source===
<?php
$a = function () use ($x, $x) {};
$b = function () use ($x, &$x) {};
$c = function () use ($x, $y, $x) {};
$d = function ($x) use ($x) {};
$e = function ($x, $y) use (&$y) {};
$f = function (...$x) use ($x) {};
===errors===
Cannot use variable $x twice
Cannot use variable $x twice
Cannot use variable $x twice
Cannot use lexical variable $x as a parameter name
Cannot use lexical variable $y as a parameter name
Cannot use lexical variable $x as a parameter name
===php_error===
PHP Fatal error:  Cannot use variable $x twice in Standard input code on line 2
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
                  "Variable": "a"
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
                    "use_vars": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 28,
                            "end": 30
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 28,
                          "end": 30
                        }
                      },
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 32,
                            "end": 34
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 32,
                          "end": 34
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 38
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 38
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 40,
                  "end": 42
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 62,
                            "end": 64
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 62,
                          "end": 64
                        }
                      },
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 67,
                            "end": 69
                          }
                        },
                        "by_ref": true,
                        "span": {
                          "start": 66,
                          "end": 69
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 45,
                  "end": 73
                }
              }
            }
          },
          "span": {
            "start": 40,
            "end": 73
          }
        }
      },
      "span": {
        "start": 40,
        "end": 74
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 75,
                  "end": 77
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 97,
                            "end": 99
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 97,
                          "end": 99
                        }
                      },
                      {
                        "name": {
                          "name": "y",
                          "span": {
                            "start": 101,
                            "end": 103
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 101,
                          "end": 103
                        }
                      },
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 105,
                            "end": 107
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 105,
                          "end": 107
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 80,
                  "end": 111
                }
              }
            }
          },
          "span": {
            "start": 75,
            "end": 111
          }
        }
      },
      "span": {
        "start": 75,
        "end": 112
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 113,
                  "end": 115
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 128,
                            "end": 130
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "is_readonly": false,
                        "is_final": false,
                        "visibility": null,
                        "set_visibility": null,
                        "attributes": [],
                        "span": {
                          "start": 128,
                          "end": 130
                        }
                      }
                    ],
                    "use_vars": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 137,
                            "end": 139
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 137,
                          "end": 139
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 118,
                  "end": 143
                }
              }
            }
          },
          "span": {
            "start": 113,
            "end": 143
          }
        }
      },
      "span": {
        "start": 113,
        "end": 144
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 145,
                  "end": 147
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 160,
                            "end": 162
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "is_readonly": false,
                        "is_final": false,
                        "visibility": null,
                        "set_visibility": null,
                        "attributes": [],
                        "span": {
                          "start": 160,
                          "end": 162
                        }
                      },
                      {
                        "name": {
                          "name": "y",
                          "span": {
                            "start": 164,
                            "end": 166
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "is_readonly": false,
                        "is_final": false,
                        "visibility": null,
                        "set_visibility": null,
                        "attributes": [],
                        "span": {
                          "start": 164,
                          "end": 166
                        }
                      }
                    ],
                    "use_vars": [
                      {
                        "name": {
                          "name": "y",
                          "span": {
                            "start": 174,
                            "end": 176
                          }
                        },
                        "by_ref": true,
                        "span": {
                          "start": 173,
                          "end": 176
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 150,
                  "end": 180
                }
              }
            }
          },
          "span": {
            "start": 145,
            "end": 180
          }
        }
      },
      "span": {
        "start": 145,
        "end": 181
      }
    },
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
                  "start": 182,
                  "end": 184
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 200,
                            "end": 202
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": true,
                        "is_readonly": false,
                        "is_final": false,
                        "visibility": null,
                        "set_visibility": null,
                        "attributes": [],
                        "span": {
                          "start": 197,
                          "end": 202
                        }
                      }
                    ],
                    "use_vars": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 209,
                            "end": 211
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 209,
                          "end": 211
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 187,
                  "end": 215
                }
              }
            }
          },
          "span": {
            "start": 182,
            "end": 215
          }
        }
      },
      "span": {
        "start": 182,
        "end": 216
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 216
  }
}
