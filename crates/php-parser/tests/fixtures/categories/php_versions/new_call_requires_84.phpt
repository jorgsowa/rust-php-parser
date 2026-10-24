===source===
<?php
$a = new Foo()();
$b = new class {}();
$c = new class {}->bar;
===errors <=8.3===
'dereferencing a new expression without parentheses' requires PHP 8.4 or higher
'dereferencing a new expression without parentheses' requires PHP 8.4 or higher
'dereferencing a new expression without parentheses' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 2
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
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 15,
                                  "end": 18
                                }
                              }
                            },
                            "span": {
                              "start": 15,
                              "end": 18
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 20
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
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
                  "start": 24,
                  "end": 26
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
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
                                "members": [],
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 29,
                              "end": 41
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 41
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 29,
                  "end": 43
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 43
          }
        }
      },
      "span": {
        "start": 24,
        "end": 44
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
                  "start": 45,
                  "end": 47
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
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
                                "members": [],
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 50,
                              "end": 62
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 50,
                        "end": 62
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "bar"
                      },
                      "span": {
                        "start": 64,
                        "end": 67
                      }
                    }
                  }
                },
                "span": {
                  "start": 50,
                  "end": 67
                }
              }
            }
          },
          "span": {
            "start": 45,
            "end": 67
          }
        }
      },
      "span": {
        "start": 45,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
