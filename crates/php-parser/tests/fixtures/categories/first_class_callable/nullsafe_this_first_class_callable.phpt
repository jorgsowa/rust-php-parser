===source===
<?php
class C {
    function f() {
        $a = $this?->foo(...);
        $b = $this?->a->b(...);
        $c = $this?->a()->b(...);
        $d = ($this)?->foo(...);
    }
}
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
'first-class callable syntax' requires PHP 8.1 or higher
===errors 8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 4
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "f",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
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
                                  "start": 43,
                                  "end": 45
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "CallableCreate": {
                                    "kind": {
                                      "NullsafeMethod": {
                                        "object": {
                                          "kind": {
                                            "Variable": "this"
                                          },
                                          "span": {
                                            "start": 48,
                                            "end": 53
                                          }
                                        },
                                        "method": {
                                          "kind": {
                                            "Identifier": "foo"
                                          },
                                          "span": {
                                            "start": 56,
                                            "end": 59
                                          }
                                        }
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 48,
                                  "end": 64
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 64
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 65
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
                                  "start": 74,
                                  "end": 76
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "CallableCreate": {
                                    "kind": {
                                      "Method": {
                                        "object": {
                                          "kind": {
                                            "NullsafePropertyAccess": {
                                              "object": {
                                                "kind": {
                                                  "Variable": "this"
                                                },
                                                "span": {
                                                  "start": 79,
                                                  "end": 84
                                                }
                                              },
                                              "property": {
                                                "kind": {
                                                  "Identifier": "a"
                                                },
                                                "span": {
                                                  "start": 87,
                                                  "end": 88
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 79,
                                            "end": 88
                                          }
                                        },
                                        "method": {
                                          "kind": {
                                            "Identifier": "b"
                                          },
                                          "span": {
                                            "start": 90,
                                            "end": 91
                                          }
                                        }
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 79,
                                  "end": 96
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 74,
                            "end": 96
                          }
                        }
                      },
                      "span": {
                        "start": 74,
                        "end": 97
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
                                  "start": 106,
                                  "end": 108
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "CallableCreate": {
                                    "kind": {
                                      "Method": {
                                        "object": {
                                          "kind": {
                                            "NullsafeMethodCall": {
                                              "object": {
                                                "kind": {
                                                  "Variable": "this"
                                                },
                                                "span": {
                                                  "start": 111,
                                                  "end": 116
                                                }
                                              },
                                              "method": {
                                                "kind": {
                                                  "Identifier": "a"
                                                },
                                                "span": {
                                                  "start": 119,
                                                  "end": 120
                                                }
                                              },
                                              "args": []
                                            }
                                          },
                                          "span": {
                                            "start": 111,
                                            "end": 122
                                          }
                                        },
                                        "method": {
                                          "kind": {
                                            "Identifier": "b"
                                          },
                                          "span": {
                                            "start": 124,
                                            "end": 125
                                          }
                                        }
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 111,
                                  "end": 130
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 106,
                            "end": 130
                          }
                        }
                      },
                      "span": {
                        "start": 106,
                        "end": 131
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
                                  "start": 140,
                                  "end": 142
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "CallableCreate": {
                                    "kind": {
                                      "NullsafeMethod": {
                                        "object": {
                                          "kind": {
                                            "Parenthesized": {
                                              "kind": {
                                                "Variable": "this"
                                              },
                                              "span": {
                                                "start": 146,
                                                "end": 151
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 145,
                                            "end": 152
                                          }
                                        },
                                        "method": {
                                          "kind": {
                                            "Identifier": "foo"
                                          },
                                          "span": {
                                            "start": 155,
                                            "end": 158
                                          }
                                        }
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 145,
                                  "end": 163
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 140,
                            "end": 163
                          }
                        }
                      },
                      "span": {
                        "start": 140,
                        "end": 164
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 170
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 172
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 172
  }
}
