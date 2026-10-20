===source===
<?php
OBJ->a = 1;
C::O->a = 1;
ARR[0] = 1;
TRUE->a = 1;
(new A)->a = 1;
($a ?? $b)->a = 1;
OBJ->a->b[] = 1;
OBJ->a++;
unset(OBJ->a);
foreach ($x as OBJ->a) {}
[OBJ->a] = [1];
OBJ?->a = 1;
===errors===
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Assignments can only happen to writable values
Can't use nullsafe operator in write context
===php_error <=8.5===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 4
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "OBJ"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 6,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 9
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 15,
                  "end": 16
                }
              }
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
                  "PropertyAccess": {
                    "object": {
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
                                  "start": 18,
                                  "end": 19
                                }
                              }
                            },
                            "span": {
                              "start": 18,
                              "end": 19
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "O"
                            },
                            "span": {
                              "start": 21,
                              "end": 22
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 22
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    }
                  }
                },
                "span": {
                  "start": 18,
                  "end": 25
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 28,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 18,
            "end": 29
          }
        }
      },
      "span": {
        "start": 18,
        "end": 30
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "ARR"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 31,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 34
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 35,
                        "end": 36
                      }
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 37
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 40,
                  "end": 41
                }
              }
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
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 43,
                        "end": 47
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 49,
                        "end": 50
                      }
                    }
                  }
                },
                "span": {
                  "start": 43,
                  "end": 50
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 53,
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
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
                                      "start": 61,
                                      "end": 62
                                    }
                                  }
                                },
                                "span": {
                                  "start": 61,
                                  "end": 62
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 57,
                            "end": 62
                          }
                        }
                      },
                      "span": {
                        "start": 56,
                        "end": 63
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 65,
                        "end": 66
                      }
                    }
                  }
                },
                "span": {
                  "start": 56,
                  "end": 66
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 69,
                  "end": 70
                }
              }
            }
          },
          "span": {
            "start": 56,
            "end": 70
          }
        }
      },
      "span": {
        "start": 56,
        "end": 71
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "NullCoalesce": {
                              "left": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 73,
                                  "end": 75
                                }
                              },
                              "right": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 79,
                                  "end": 81
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 73,
                            "end": 81
                          }
                        }
                      },
                      "span": {
                        "start": 72,
                        "end": 82
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 84,
                        "end": 85
                      }
                    }
                  }
                },
                "span": {
                  "start": 72,
                  "end": 85
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 88,
                  "end": 89
                }
              }
            }
          },
          "span": {
            "start": 72,
            "end": 89
          }
        }
      },
      "span": {
        "start": 72,
        "end": 90
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "PropertyAccess": {
                                "object": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "OBJ"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 91,
                                        "end": 94
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 91,
                                    "end": 94
                                  }
                                },
                                "property": {
                                  "kind": {
                                    "Identifier": "a"
                                  },
                                  "span": {
                                    "start": 96,
                                    "end": 97
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 91,
                              "end": 97
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 99,
                              "end": 100
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 91,
                        "end": 100
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 91,
                  "end": 102
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 105,
                  "end": 106
                }
              }
            }
          },
          "span": {
            "start": 91,
            "end": 106
          }
        }
      },
      "span": {
        "start": 91,
        "end": 107
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "OBJ"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 108,
                            "end": 111
                          }
                        }
                      },
                      "span": {
                        "start": 108,
                        "end": 111
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 113,
                        "end": 114
                      }
                    }
                  }
                },
                "span": {
                  "start": 108,
                  "end": 114
                }
              },
              "op": "PostIncrement"
            }
          },
          "span": {
            "start": 108,
            "end": 116
          }
        }
      },
      "span": {
        "start": 108,
        "end": 117
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "OBJ"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 124,
                        "end": 127
                      }
                    }
                  },
                  "span": {
                    "start": 124,
                    "end": 127
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "a"
                  },
                  "span": {
                    "start": 129,
                    "end": 130
                  }
                }
              }
            },
            "span": {
              "start": 124,
              "end": 130
            }
          }
        ]
      },
      "span": {
        "start": 118,
        "end": 132
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 142,
              "end": 144
            }
          },
          "key": null,
          "value": {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "OBJ"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 148,
                        "end": 151
                      }
                    }
                  },
                  "span": {
                    "start": 148,
                    "end": 151
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "a"
                  },
                  "span": {
                    "start": 153,
                    "end": 154
                  }
                }
              }
            },
            "span": {
              "start": 148,
              "end": 154
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 156,
              "end": 158
            }
          }
        }
      },
      "span": {
        "start": 133,
        "end": 158
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
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "OBJ"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 160,
                                      "end": 163
                                    }
                                  }
                                },
                                "span": {
                                  "start": 160,
                                  "end": 163
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "a"
                                },
                                "span": {
                                  "start": 165,
                                  "end": 166
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 160,
                            "end": 166
                          }
                        }
                      },
                      "span": {
                        "start": 160,
                        "end": 166
                      }
                    }
                  ]
                },
                "span": {
                  "start": 159,
                  "end": 167
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
                            "start": 171,
                            "end": 172
                          }
                        }
                      },
                      "span": {
                        "start": 171,
                        "end": 172
                      }
                    }
                  ]
                },
                "span": {
                  "start": 170,
                  "end": 173
                }
              }
            }
          },
          "span": {
            "start": 159,
            "end": 173
          }
        }
      },
      "span": {
        "start": 159,
        "end": 174
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "OBJ"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 175,
                            "end": 178
                          }
                        }
                      },
                      "span": {
                        "start": 175,
                        "end": 178
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 181,
                        "end": 182
                      }
                    }
                  }
                },
                "span": {
                  "start": 175,
                  "end": 182
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 185,
                  "end": 186
                }
              }
            }
          },
          "span": {
            "start": 175,
            "end": 186
          }
        }
      },
      "span": {
        "start": 175,
        "end": 187
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 187
  }
}
