===source===
<?php
function match($a) { return $a; }
class Match { const X = 1; }
const MATCH = 2;
echo match(1), Match::X, MATCH, match(...[1])->y;
match:
goto match;
===errors >=8.0===
cannot use 'match' as function name; it is reserved
Cannot use "Match" as a class name as it is reserved
cannot use 'MATCH' as constant name as it is reserved
expected '{', found ','
expected '(', found '::'
expected ')', found ','
expected '(', found ','
expected expression, found '...'
expected '(', found ':'
expected identifier, found 'match'
expected '(', found ';'
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "match", expecting "(" in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "match",
            "span": {
              "start": 15,
              "end": 20
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 21,
                  "end": 23
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 21,
                "end": 23
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 34,
                    "end": 36
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 37
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Match",
            "span": {
              "start": 46,
              "end": 51
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
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 60,
                      "end": 61
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 64,
                      "end": 65
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 66
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 40,
        "end": 68
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "MATCH",
              "span": {
                "start": 75,
                "end": 80
              }
            },
            "value": {
              "kind": {
                "Int": 2
              },
              "span": {
                "start": 83,
                "end": 84
              }
            },
            "attributes": [],
            "span": {
              "start": 75,
              "end": 84
            }
          }
        ]
      },
      "span": {
        "start": 69,
        "end": 85
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "FunctionCall": {
                "name": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "match"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 91,
                        "end": 96
                      }
                    }
                  },
                  "span": {
                    "start": 91,
                    "end": 96
                  }
                },
                "args": [
                  {
                    "name": null,
                    "kind": {
                      "Value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 97,
                          "end": 98
                        }
                      }
                    },
                    "span": {
                      "start": 97,
                      "end": 98
                    }
                  }
                ]
              }
            },
            "span": {
              "start": 91,
              "end": 99
            }
          },
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "Match"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 101,
                        "end": 106
                      }
                    }
                  },
                  "span": {
                    "start": 101,
                    "end": 106
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "X"
                  },
                  "span": {
                    "start": 108,
                    "end": 109
                  }
                }
              }
            },
            "span": {
              "start": 101,
              "end": 109
            }
          },
          {
            "kind": {
              "Name": {
                "parts": [
                  "MATCH"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 111,
                  "end": 116
                }
              }
            },
            "span": {
              "start": 111,
              "end": 116
            }
          },
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "match"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 118,
                              "end": 123
                            }
                          }
                        },
                        "span": {
                          "start": 118,
                          "end": 123
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Spread": {
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
                                          "start": 128,
                                          "end": 129
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 128,
                                      "end": 129
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 127,
                                "end": 130
                              }
                            }
                          },
                          "span": {
                            "start": 124,
                            "end": 130
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 118,
                    "end": 131
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "y"
                  },
                  "span": {
                    "start": 133,
                    "end": 134
                  }
                }
              }
            },
            "span": {
              "start": 118,
              "end": 134
            }
          }
        ]
      },
      "span": {
        "start": 86,
        "end": 135
      }
    },
    {
      "kind": {
        "Label": {
          "name": "match",
          "span": {
            "start": 136,
            "end": 141
          }
        }
      },
      "span": {
        "start": 136,
        "end": 142
      }
    },
    {
      "kind": {
        "Goto": {
          "name": "match",
          "span": {
            "start": 148,
            "end": 153
          }
        }
      },
      "span": {
        "start": 143,
        "end": 154
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 154
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "match",
            "span": {
              "start": 15,
              "end": 20
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 21,
                  "end": 23
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 21,
                "end": 23
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 34,
                    "end": 36
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 37
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Match",
            "span": {
              "start": 46,
              "end": 51
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
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 60,
                      "end": 61
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 64,
                      "end": 65
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 66
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 40,
        "end": 68
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "MATCH",
              "span": {
                "start": 75,
                "end": 80
              }
            },
            "value": {
              "kind": {
                "Int": 2
              },
              "span": {
                "start": 83,
                "end": 84
              }
            },
            "attributes": [],
            "span": {
              "start": 75,
              "end": 84
            }
          }
        ]
      },
      "span": {
        "start": 69,
        "end": 85
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Match": {
                "subject": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 97,
                    "end": 98
                  }
                },
                "arms": [
                  {
                    "conditions": [
                      {
                        "kind": "Error",
                        "span": {
                          "start": 99,
                          "end": 99
                        }
                      },
                      {
                        "kind": {
                          "Match": {
                            "subject": {
                              "kind": {
                                "ClassConstAccess": {
                                  "class": {
                                    "kind": "Error",
                                    "span": {
                                      "start": 106,
                                      "end": 106
                                    }
                                  },
                                  "member": {
                                    "kind": {
                                      "Identifier": "X"
                                    },
                                    "span": {
                                      "start": 108,
                                      "end": 109
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 106,
                                "end": 109
                              }
                            },
                            "arms": [
                              {
                                "conditions": [
                                  {
                                    "kind": "Error",
                                    "span": {
                                      "start": 109,
                                      "end": 109
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Match": {
                                        "subject": {
                                          "kind": "Error",
                                          "span": {
                                            "start": 116,
                                            "end": 116
                                          }
                                        },
                                        "arms": [
                                          {
                                            "conditions": [
                                              {
                                                "kind": "Error",
                                                "span": {
                                                  "start": 116,
                                                  "end": 116
                                                }
                                              },
                                              {
                                                "kind": {
                                                  "Match": {
                                                    "subject": {
                                                      "kind": "Error",
                                                      "span": {
                                                        "start": 124,
                                                        "end": 124
                                                      }
                                                    },
                                                    "arms": [
                                                      {
                                                        "conditions": [
                                                          {
                                                            "kind": "Error",
                                                            "span": {
                                                              "start": 124,
                                                              "end": 124
                                                            }
                                                          }
                                                        ],
                                                        "body": {
                                                          "kind": "Error",
                                                          "span": {
                                                            "start": 124,
                                                            "end": 124
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 124,
                                                          "end": 124
                                                        }
                                                      }
                                                    ]
                                                  }
                                                },
                                                "span": {
                                                  "start": 118,
                                                  "end": 124
                                                }
                                              }
                                            ],
                                            "body": {
                                              "kind": "Error",
                                              "span": {
                                                "start": 124,
                                                "end": 124
                                              }
                                            },
                                            "span": {
                                              "start": 116,
                                              "end": 124
                                            }
                                          },
                                          {
                                            "conditions": [
                                              {
                                                "kind": "Error",
                                                "span": {
                                                  "start": 124,
                                                  "end": 124
                                                }
                                              }
                                            ],
                                            "body": {
                                              "kind": "Error",
                                              "span": {
                                                "start": 124,
                                                "end": 124
                                              }
                                            },
                                            "span": {
                                              "start": 124,
                                              "end": 124
                                            }
                                          }
                                        ]
                                      }
                                    },
                                    "span": {
                                      "start": 111,
                                      "end": 124
                                    }
                                  }
                                ],
                                "body": {
                                  "kind": "Error",
                                  "span": {
                                    "start": 124,
                                    "end": 124
                                  }
                                },
                                "span": {
                                  "start": 109,
                                  "end": 124
                                }
                              },
                              {
                                "conditions": [
                                  {
                                    "kind": "Error",
                                    "span": {
                                      "start": 124,
                                      "end": 124
                                    }
                                  }
                                ],
                                "body": {
                                  "kind": "Error",
                                  "span": {
                                    "start": 124,
                                    "end": 124
                                  }
                                },
                                "span": {
                                  "start": 124,
                                  "end": 124
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 101,
                          "end": 124
                        }
                      }
                    ],
                    "body": {
                      "kind": "Error",
                      "span": {
                        "start": 124,
                        "end": 124
                      }
                    },
                    "span": {
                      "start": 99,
                      "end": 124
                    }
                  },
                  {
                    "conditions": [
                      {
                        "kind": "Error",
                        "span": {
                          "start": 124,
                          "end": 124
                        }
                      }
                    ],
                    "body": {
                      "kind": "Error",
                      "span": {
                        "start": 124,
                        "end": 124
                      }
                    },
                    "span": {
                      "start": 124,
                      "end": 124
                    }
                  }
                ]
              }
            },
            "span": {
              "start": 91,
              "end": 124
            }
          }
        ]
      },
      "span": {
        "start": 86,
        "end": 124
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 124,
        "end": 135
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Match": {
              "subject": {
                "kind": "Error",
                "span": {
                  "start": 141,
                  "end": 141
                }
              },
              "arms": [
                {
                  "conditions": [
                    {
                      "kind": "Error",
                      "span": {
                        "start": 141,
                        "end": 141
                      }
                    }
                  ],
                  "body": {
                    "kind": "Error",
                    "span": {
                      "start": 141,
                      "end": 141
                    }
                  },
                  "span": {
                    "start": 141,
                    "end": 141
                  }
                }
              ]
            }
          },
          "span": {
            "start": 136,
            "end": 141
          }
        }
      },
      "span": {
        "start": 136,
        "end": 141
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 141,
        "end": 142
      }
    },
    {
      "kind": {
        "Goto": null
      },
      "span": {
        "start": 143,
        "end": 147
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Match": {
              "subject": {
                "kind": "Error",
                "span": {
                  "start": 153,
                  "end": 153
                }
              },
              "arms": [
                {
                  "conditions": [
                    {
                      "kind": "Error",
                      "span": {
                        "start": 153,
                        "end": 153
                      }
                    }
                  ],
                  "body": {
                    "kind": "Error",
                    "span": {
                      "start": 153,
                      "end": 153
                    }
                  },
                  "span": {
                    "start": 153,
                    "end": 153
                  }
                }
              ]
            }
          },
          "span": {
            "start": 148,
            "end": 153
          }
        }
      },
      "span": {
        "start": 148,
        "end": 154
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 154
  }
}
