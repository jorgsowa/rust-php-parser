===source===
<?php
$a = &C::X;
$a = &"s";
$a = &FOO->b;
[&$a] = [1];
[$a, [&$b]] = [1];
list(&$a) = FOO;
[&$a] = new A;
[&$a] = $b?->c;
===errors <=7.4===
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
'object access on a constant' requires PHP 8.0 or higher
Cannot use temporary expression in write context
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
'nullsafe operator (?->)' requires PHP 8.0 or higher
===errors 8.0===
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot use temporary expression in write context
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
===errors 8.1-8.5===
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot use temporary expression in write context
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot take reference of a nullsafe chain
===errors >=8.6===
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot assign reference to non referenceable value
Cannot take reference of a nullsafe chain
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting '[' in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token ";", expecting "->" or "?->" or "{" or "[" in Standard input code on line 2
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token ";", expecting "->" or "?->" or "[" in Standard input code on line 2
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
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 12,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 13
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "X"
                      },
                      "span": {
                        "start": 15,
                        "end": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 16
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
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
                  "start": 18,
                  "end": 20
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "s"
                },
                "span": {
                  "start": 24,
                  "end": 27
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 18,
            "end": 27
          }
        }
      },
      "span": {
        "start": 18,
        "end": 28
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
                  "start": 29,
                  "end": 31
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "FOO"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 35,
                            "end": 38
                          }
                        }
                      },
                      "span": {
                        "start": 35,
                        "end": 38
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 40,
                        "end": 41
                      }
                    }
                  }
                },
                "span": {
                  "start": 35,
                  "end": 41
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 29,
            "end": 41
          }
        }
      },
      "span": {
        "start": 29,
        "end": 42
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
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 45,
                            "end": 47
                          }
                        }
                      },
                      "span": {
                        "start": 44,
                        "end": 47
                      }
                    }
                  ]
                },
                "span": {
                  "start": 43,
                  "end": 48
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
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
                    }
                  ]
                },
                "span": {
                  "start": 51,
                  "end": 54
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 54
          }
        }
      },
      "span": {
        "start": 43,
        "end": 55
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
                            "start": 57,
                            "end": 59
                          }
                        }
                      },
                      "span": {
                        "start": 57,
                        "end": 59
                      }
                    },
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
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 63,
                                      "end": 65
                                    }
                                  }
                                },
                                "span": {
                                  "start": 62,
                                  "end": 65
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 61,
                            "end": 66
                          }
                        }
                      },
                      "span": {
                        "start": 61,
                        "end": 66
                      }
                    }
                  ]
                },
                "span": {
                  "start": 56,
                  "end": 67
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 71,
                            "end": 72
                          }
                        }
                      },
                      "span": {
                        "start": 71,
                        "end": 72
                      }
                    }
                  ]
                },
                "span": {
                  "start": 70,
                  "end": 73
                }
              }
            }
          },
          "span": {
            "start": 56,
            "end": 73
          }
        }
      },
      "span": {
        "start": 56,
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 81,
                            "end": 83
                          }
                        }
                      },
                      "span": {
                        "start": 80,
                        "end": 83
                      }
                    }
                  ]
                },
                "span": {
                  "start": 75,
                  "end": 84
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Name": {
                    "parts": [
                      "FOO"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 87,
                      "end": 90
                    }
                  }
                },
                "span": {
                  "start": 87,
                  "end": 90
                }
              }
            }
          },
          "span": {
            "start": 75,
            "end": 90
          }
        }
      },
      "span": {
        "start": 75,
        "end": 91
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
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 94,
                            "end": 96
                          }
                        }
                      },
                      "span": {
                        "start": 93,
                        "end": 96
                      }
                    }
                  ]
                },
                "span": {
                  "start": 92,
                  "end": 97
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 104,
                            "end": 105
                          }
                        }
                      },
                      "span": {
                        "start": 104,
                        "end": 105
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 100,
                  "end": 105
                }
              }
            }
          },
          "span": {
            "start": 92,
            "end": 105
          }
        }
      },
      "span": {
        "start": 92,
        "end": 106
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
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 109,
                            "end": 111
                          }
                        }
                      },
                      "span": {
                        "start": 108,
                        "end": 111
                      }
                    }
                  ]
                },
                "span": {
                  "start": 107,
                  "end": 112
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 115,
                        "end": 117
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "c"
                      },
                      "span": {
                        "start": 120,
                        "end": 121
                      }
                    }
                  }
                },
                "span": {
                  "start": 115,
                  "end": 121
                }
              }
            }
          },
          "span": {
            "start": 107,
            "end": 121
          }
        }
      },
      "span": {
        "start": 107,
        "end": 122
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 122
  }
}
