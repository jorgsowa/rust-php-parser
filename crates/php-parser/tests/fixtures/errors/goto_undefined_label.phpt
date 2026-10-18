===source===
<?php
outer:
goto missing;
goto Outer;
function f() {
    goto outer;
}
class C {
    public function m() {
        goto outer;
    }
}
$f = function () {
    goto outer;
};
===errors===
'goto' to undefined label 'outer'
'goto' to undefined label 'outer'
'goto' to undefined label 'outer'
'goto' to undefined label 'missing'
'goto' to undefined label 'Outer'
===php_error===
PHP Fatal error:  'goto' to undefined label 'outer' in Standard input code on line 6
===ast===
{
  "stmts": [
    {
      "kind": {
        "Label": {
          "name": "outer",
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    },
    {
      "kind": {
        "Goto": {
          "name": "missing",
          "span": {
            "start": 18,
            "end": 25
          }
        }
      },
      "span": {
        "start": 13,
        "end": 26
      }
    },
    {
      "kind": {
        "Goto": {
          "name": "Outer",
          "span": {
            "start": 32,
            "end": 37
          }
        }
      },
      "span": {
        "start": 27,
        "end": 38
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 48,
              "end": 49
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Goto": {
                  "name": "outer",
                  "span": {
                    "start": 63,
                    "end": 68
                  }
                }
              },
              "span": {
                "start": 58,
                "end": 69
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 39,
        "end": 71
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 78,
              "end": 79
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
                      "start": 102,
                      "end": 103
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Goto": {
                          "name": "outer",
                          "span": {
                            "start": 121,
                            "end": 126
                          }
                        }
                      },
                      "span": {
                        "start": 116,
                        "end": 127
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 86,
                "end": 133
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 72,
        "end": 135
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
                  "start": 136,
                  "end": 138
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
                          "Goto": {
                            "name": "outer",
                            "span": {
                              "start": 164,
                              "end": 169
                            }
                          }
                        },
                        "span": {
                          "start": 159,
                          "end": 170
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 141,
                  "end": 172
                }
              }
            }
          },
          "span": {
            "start": 136,
            "end": 172
          }
        }
      },
      "span": {
        "start": 136,
        "end": 173
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 173
  }
}
