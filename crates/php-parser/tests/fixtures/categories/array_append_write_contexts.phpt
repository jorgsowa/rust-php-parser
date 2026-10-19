===source===
<?php
$a[][] = 1;
$a[]->x = 1;
$x = &$a[];
[$a[], [$a[]]] = [1, [2]];
list($a[]) = [1];
foreach ($b as $k => $a[]) {}
f($a[], $a[][0]);
$a[] += 1;
$a[]++;
$f = function () { $a[] = 1; };
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 6,
                              "end": 8
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 10
                      }
                    },
                    "index": null
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
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 18,
                              "end": 20
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 22
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "x"
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
                  "Variable": "x"
                },
                "span": {
                  "start": 31,
                  "end": 33
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 37,
                        "end": 39
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 37,
                  "end": 41
                }
              },
              "by_ref": true
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 44,
                                  "end": 46
                                }
                              },
                              "index": null
                            }
                          },
                          "span": {
                            "start": 44,
                            "end": 48
                          }
                        }
                      },
                      "span": {
                        "start": 44,
                        "end": 48
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
                                  "Value": {
                                    "kind": {
                                      "ArrayAccess": {
                                        "array": {
                                          "kind": {
                                            "Variable": "a"
                                          },
                                          "span": {
                                            "start": 51,
                                            "end": 53
                                          }
                                        },
                                        "index": null
                                      }
                                    },
                                    "span": {
                                      "start": 51,
                                      "end": 55
                                    }
                                  }
                                },
                                "span": {
                                  "start": 51,
                                  "end": 55
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 50,
                            "end": 56
                          }
                        }
                      },
                      "span": {
                        "start": 50,
                        "end": 56
                      }
                    }
                  ]
                },
                "span": {
                  "start": 43,
                  "end": 57
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
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 65,
                                      "end": 66
                                    }
                                  }
                                },
                                "span": {
                                  "start": 65,
                                  "end": 66
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 64,
                            "end": 67
                          }
                        }
                      },
                      "span": {
                        "start": 64,
                        "end": 67
                      }
                    }
                  ]
                },
                "span": {
                  "start": 60,
                  "end": 68
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 68
          }
        }
      },
      "span": {
        "start": 43,
        "end": 69
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
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 75,
                                  "end": 77
                                }
                              },
                              "index": null
                            }
                          },
                          "span": {
                            "start": 75,
                            "end": 79
                          }
                        }
                      },
                      "span": {
                        "start": 75,
                        "end": 79
                      }
                    }
                  ]
                },
                "span": {
                  "start": 70,
                  "end": 80
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
                  "start": 83,
                  "end": 86
                }
              }
            }
          },
          "span": {
            "start": 70,
            "end": 86
          }
        }
      },
      "span": {
        "start": 70,
        "end": 87
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 97,
              "end": 99
            }
          },
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 103,
              "end": 105
            }
          },
          "value": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 109,
                    "end": 111
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 109,
              "end": 113
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 115,
              "end": 117
            }
          }
        }
      },
      "span": {
        "start": 88,
        "end": 117
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
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 118,
                      "end": 119
                    }
                  }
                },
                "span": {
                  "start": 118,
                  "end": 119
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 120,
                              "end": 122
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 120,
                        "end": 124
                      }
                    }
                  },
                  "span": {
                    "start": 120,
                    "end": 124
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 126,
                                    "end": 128
                                  }
                                },
                                "index": null
                              }
                            },
                            "span": {
                              "start": 126,
                              "end": 130
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 131,
                              "end": 132
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 126,
                        "end": 133
                      }
                    }
                  },
                  "span": {
                    "start": 126,
                    "end": 133
                  }
                }
              ]
            }
          },
          "span": {
            "start": 118,
            "end": 134
          }
        }
      },
      "span": {
        "start": 118,
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 136,
                        "end": 138
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 136,
                  "end": 140
                }
              },
              "op": "Plus",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 144,
                  "end": 145
                }
              }
            }
          },
          "span": {
            "start": 136,
            "end": 145
          }
        }
      },
      "span": {
        "start": 136,
        "end": 146
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 147,
                        "end": 149
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 147,
                  "end": 151
                }
              },
              "op": "PostIncrement"
            }
          },
          "span": {
            "start": 147,
            "end": 153
          }
        }
      },
      "span": {
        "start": 147,
        "end": 154
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
                  "start": 155,
                  "end": 157
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
                          "Expression": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "ArrayAccess": {
                                      "array": {
                                        "kind": {
                                          "Variable": "a"
                                        },
                                        "span": {
                                          "start": 174,
                                          "end": 176
                                        }
                                      },
                                      "index": null
                                    }
                                  },
                                  "span": {
                                    "start": 174,
                                    "end": 178
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 181,
                                    "end": 182
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 174,
                              "end": 182
                            }
                          }
                        },
                        "span": {
                          "start": 174,
                          "end": 183
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 160,
                  "end": 185
                }
              }
            }
          },
          "span": {
            "start": 155,
            "end": 185
          }
        }
      },
      "span": {
        "start": 155,
        "end": 186
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 186
  }
}
