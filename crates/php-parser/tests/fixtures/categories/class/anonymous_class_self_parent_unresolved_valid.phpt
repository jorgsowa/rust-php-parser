===source===
<?php
class A {}
$a = new class {
    function g(): A|self {}
};
$b = new class extends A {
    function g(): A|parent {}
};
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 4
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
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
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
                  "start": 17,
                  "end": 19
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
                                    "name": "g",
                                    "span": {
                                      "start": 47,
                                      "end": 48
                                    }
                                  },
                                  "by_ref": false,
                                  "params": [],
                                  "return_type": {
                                    "kind": {
                                      "Union": [
                                        {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "A"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 52,
                                                "end": 53
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 52,
                                            "end": 53
                                          }
                                        },
                                        {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "self"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 54,
                                                "end": 58
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 54,
                                            "end": 58
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 52,
                                      "end": 58
                                    }
                                  },
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 38,
                                "end": 61
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 63
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 22,
                  "end": 63
                }
              }
            }
          },
          "span": {
            "start": 17,
            "end": 63
          }
        }
      },
      "span": {
        "start": 17,
        "end": 64
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
                  "start": 65,
                  "end": 67
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
                          "extends": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 88,
                              "end": 89
                            }
                          },
                          "implements": [],
                          "members": [
                            {
                              "kind": {
                                "Method": {
                                  "name": {
                                    "name": "g",
                                    "span": {
                                      "start": 105,
                                      "end": 106
                                    }
                                  },
                                  "by_ref": false,
                                  "params": [],
                                  "return_type": {
                                    "kind": {
                                      "Union": [
                                        {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "A"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 110,
                                                "end": 111
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 110,
                                            "end": 111
                                          }
                                        },
                                        {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "parent"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 112,
                                                "end": 118
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 112,
                                            "end": 118
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 110,
                                      "end": 118
                                    }
                                  },
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 96,
                                "end": 121
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 123
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 70,
                  "end": 123
                }
              }
            }
          },
          "span": {
            "start": 65,
            "end": 123
          }
        }
      },
      "span": {
        "start": 65,
        "end": 124
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 124
  }
}
