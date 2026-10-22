===source===
<?php
function a(): object|A {}
function b(): int|A|object|null {}
function c(): (A&B)|object {}
function d(): iterable|object|Closure {}
class C extends P {
    public function e(): object|self {}
    public function f(): parent|object {}
    public function g(): object|static {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Type A|object contains both object and a class type, which is redundant
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
Type A|object|int|null contains both object and a class type, which is redundant
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'DNF types' requires PHP 8.2 or higher
Type (A&B)|object contains both object and a class type, which is redundant
'union types' requires PHP 8.0 or higher
Type Traversable|Closure|object|array contains both object and a class type, which is redundant
'union types' requires PHP 8.0 or higher
Type self|object contains both object and a class type, which is redundant
'union types' requires PHP 8.0 or higher
Type parent|object contains both object and a class type, which is redundant
'union types' requires PHP 8.0 or higher
'static type' requires PHP 8.0 or higher
Type static|object contains both object and a class type, which is redundant
===errors 8.0===
Type A|object contains both object and a class type, which is redundant
Type A|object|int|null contains both object and a class type, which is redundant
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
Type (A&B)|object contains both object and a class type, which is redundant
Type Traversable|Closure|object|array contains both object and a class type, which is redundant
Type self|object contains both object and a class type, which is redundant
Type parent|object contains both object and a class type, which is redundant
Type static|object contains both object and a class type, which is redundant
===errors 8.1===
Type A|object contains both object and a class type, which is redundant
Type A|object|int|null contains both object and a class type, which is redundant
'DNF types' requires PHP 8.2 or higher
Type (A&B)|object contains both object and a class type, which is redundant
Type Traversable|Closure|object|array contains both object and a class type, which is redundant
Type self|object contains both object and a class type, which is redundant
Type parent|object contains both object and a class type, which is redundant
Type static|object contains both object and a class type, which is redundant
===errors 8.2-8.4===
Type A|object contains both object and a class type, which is redundant
Type A|object|int|null contains both object and a class type, which is redundant
Type (A&B)|object contains both object and a class type, which is redundant
Type Traversable|Closure|object|array contains both object and a class type, which is redundant
Type self|object contains both object and a class type, which is redundant
Type parent|object contains both object and a class type, which is redundant
Type static|object contains both object and a class type, which is redundant
===errors >=8.5===
Type A|object contains both object and a class type, which is redundant
Type A|object|int|null contains both object and a class type, which is redundant
Type (A&B)|object contains both object and a class type, which is redundant
Type Traversable|Closure|object|array contains both object and a class type, which is redundant
Type C|object contains both object and a class type, which is redundant
Type P|object contains both object and a class type, which is redundant
Type static|object contains both object and a class type, which is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 4
===php_error >=8.2===
PHP Fatal error:  Type A|object contains both object and a class type, which is redundant in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 26
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 26
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 27,
                        "end": 28
                      }
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 28
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 28
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 41,
              "end": 42
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 46,
                        "end": 49
                      }
                    }
                  },
                  "span": {
                    "start": 46,
                    "end": 49
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 50,
                        "end": 51
                      }
                    }
                  },
                  "span": {
                    "start": 50,
                    "end": 51
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 52,
                        "end": 58
                      }
                    }
                  },
                  "span": {
                    "start": 52,
                    "end": 58
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "null"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 59,
                        "end": 63
                      }
                    }
                  },
                  "span": {
                    "start": 59,
                    "end": 63
                  }
                }
              ]
            },
            "span": {
              "start": 46,
              "end": 63
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 32,
        "end": 66
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 76,
              "end": 77
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 82,
                              "end": 83
                            }
                          }
                        },
                        "span": {
                          "start": 82,
                          "end": 83
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 84,
                              "end": 85
                            }
                          }
                        },
                        "span": {
                          "start": 84,
                          "end": 85
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 81,
                    "end": 86
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 87,
                        "end": 93
                      }
                    }
                  },
                  "span": {
                    "start": 87,
                    "end": 93
                  }
                }
              ]
            },
            "span": {
              "start": 81,
              "end": 93
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 67,
        "end": 96
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "d",
            "span": {
              "start": 106,
              "end": 107
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "iterable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 111,
                        "end": 119
                      }
                    }
                  },
                  "span": {
                    "start": 111,
                    "end": 119
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 120,
                        "end": 126
                      }
                    }
                  },
                  "span": {
                    "start": 120,
                    "end": 126
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Closure"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 127,
                        "end": 134
                      }
                    }
                  },
                  "span": {
                    "start": 127,
                    "end": 134
                  }
                }
              ]
            },
            "span": {
              "start": 111,
              "end": 134
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 97,
        "end": 137
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 144,
              "end": 145
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "P"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 154,
              "end": 155
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 178,
                      "end": 179
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                                "object"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 183,
                                "end": 189
                              }
                            }
                          },
                          "span": {
                            "start": 183,
                            "end": 189
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
                                "start": 190,
                                "end": 194
                              }
                            }
                          },
                          "span": {
                            "start": 190,
                            "end": 194
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 183,
                      "end": 194
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 162,
                "end": 197
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 218,
                      "end": 219
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 223,
                                "end": 229
                              }
                            }
                          },
                          "span": {
                            "start": 223,
                            "end": 229
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "object"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 230,
                                "end": 236
                              }
                            }
                          },
                          "span": {
                            "start": 230,
                            "end": 236
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 223,
                      "end": 236
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 202,
                "end": 239
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 260,
                      "end": 261
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                                "object"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 265,
                                "end": 271
                              }
                            }
                          },
                          "span": {
                            "start": 265,
                            "end": 271
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "static"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 272,
                                "end": 278
                              }
                            }
                          },
                          "span": {
                            "start": 272,
                            "end": 278
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 265,
                      "end": 278
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 244,
                "end": 281
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 138,
        "end": 283
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 283
  }
}
