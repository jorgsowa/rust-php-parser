===source===
<?php
[&$y] = $y->y?->y;
list($a, &$b) = $o?->p[0];
[[&$c]] = ($o?->m());
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
===errors >=8.1===
Cannot take reference of a nullsafe chain
Cannot take reference of a nullsafe chain
Cannot take reference of a nullsafe chain
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot take reference of a nullsafe chain in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "y"
                          },
                          "span": {
                            "start": 8,
                            "end": 10
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 10
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "y"
                            },
                            "span": {
                              "start": 14,
                              "end": 16
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "y"
                            },
                            "span": {
                              "start": 18,
                              "end": 19
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 19
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "y"
                      },
                      "span": {
                        "start": 22,
                        "end": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 30,
                            "end": 32
                          }
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 32
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 35,
                            "end": 37
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 37
                      }
                    }
                  ]
                },
                "span": {
                  "start": 25,
                  "end": 38
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "NullsafePropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "o"
                            },
                            "span": {
                              "start": 41,
                              "end": 43
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "p"
                            },
                            "span": {
                              "start": 46,
                              "end": 47
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 41,
                        "end": 47
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 48,
                        "end": 49
                      }
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 50
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 50
          }
        }
      },
      "span": {
        "start": 25,
        "end": 51
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "ByRef": {
                                    "kind": {
                                      "Variable": "c"
                                    },
                                    "span": {
                                      "start": 55,
                                      "end": 57
                                    }
                                  }
                                },
                                "span": {
                                  "start": 54,
                                  "end": 57
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 53,
                            "end": 58
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 58
                      }
                    }
                  ]
                },
                "span": {
                  "start": 52,
                  "end": 59
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "NullsafeMethodCall": {
                        "object": {
                          "kind": {
                            "Variable": "o"
                          },
                          "span": {
                            "start": 63,
                            "end": 65
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "m"
                          },
                          "span": {
                            "start": 68,
                            "end": 69
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 63,
                      "end": 71
                    }
                  }
                },
                "span": {
                  "start": 62,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 52,
            "end": 72
          }
        }
      },
      "span": {
        "start": 52,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
