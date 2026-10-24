===source===
<?php
namespace fn;
namespace fn\use;
namespace self;
namespace parent;
namespace static;
fn\use();
\fn\use();
namespace\fn\use();
private\protected\public\static\abstract\final();
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
expected '(', found '\'
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
expected expression, found 'private'
expected 'class', found '\'
expected 'class', found '('
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'fn' (T_FN), expecting '{' in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "fn"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 18
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "fn",
              "use"
            ],
            "kind": "Qualified",
            "span": {
              "start": 30,
              "end": 36
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 20,
        "end": 37
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "self"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 48,
              "end": 52
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 38,
        "end": 53
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "parent"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 64,
              "end": 70
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 54,
        "end": 71
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "static"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 82,
              "end": 88
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 72,
        "end": 89
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "missing_param_list": true,
              "return_type": null,
              "body": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "use"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 92,
                            "end": 96
                          }
                        }
                      },
                      "span": {
                        "start": 92,
                        "end": 96
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 92,
                  "end": 98
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 90,
            "end": 98
          }
        }
      },
      "span": {
        "start": 90,
        "end": 99
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "fn",
                      "use"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 100,
                      "end": 107
                    }
                  }
                },
                "span": {
                  "start": 100,
                  "end": 107
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 100,
            "end": 109
          }
        }
      },
      "span": {
        "start": 100,
        "end": 110
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "fn",
                      "use"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 111,
                      "end": 127
                    }
                  }
                },
                "span": {
                  "start": 111,
                  "end": 127
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 111,
            "end": 129
          }
        }
      },
      "span": {
        "start": 111,
        "end": 130
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 131,
        "end": 163
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 163,
        "end": 171
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 172,
        "end": 177
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 177
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "fn"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 18
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "fn",
              "use"
            ],
            "kind": "Qualified",
            "span": {
              "start": 30,
              "end": 36
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 20,
        "end": 37
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "self"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 48,
              "end": 52
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 38,
        "end": 53
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "parent"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 64,
              "end": 70
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 54,
        "end": 71
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "static"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 82,
              "end": 88
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 72,
        "end": 89
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "fn",
                      "use"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 90,
                      "end": 96
                    }
                  }
                },
                "span": {
                  "start": 90,
                  "end": 96
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 90,
            "end": 98
          }
        }
      },
      "span": {
        "start": 90,
        "end": 99
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "fn",
                      "use"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 100,
                      "end": 107
                    }
                  }
                },
                "span": {
                  "start": 100,
                  "end": 107
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 100,
            "end": 109
          }
        }
      },
      "span": {
        "start": 100,
        "end": 110
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "fn",
                      "use"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 111,
                      "end": 127
                    }
                  }
                },
                "span": {
                  "start": 111,
                  "end": 127
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 111,
            "end": 129
          }
        }
      },
      "span": {
        "start": 111,
        "end": 130
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "private",
                      "protected",
                      "public",
                      "static",
                      "abstract",
                      "final"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 131,
                      "end": 177
                    }
                  }
                },
                "span": {
                  "start": 131,
                  "end": 177
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 131,
            "end": 179
          }
        }
      },
      "span": {
        "start": 131,
        "end": 180
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 180
  }
}
