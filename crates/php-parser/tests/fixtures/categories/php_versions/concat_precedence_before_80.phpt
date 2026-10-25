===source===
<?php
$a = "a" . 1 + 2;
$b = 1 . 2 << 1;
$c = 1 + 2 . 3 - 4;
$d = 1 << 2 . 3 >> 4;
===ast <=7.4===
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "String": "a"
                            },
                            "span": {
                              "start": 11,
                              "end": 14
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 18
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 21,
                        "end": 22
                      }
                    }
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 29,
                              "end": 30
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 33,
                              "end": 34
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 34
                      }
                    },
                    "op": "ShiftLeft",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 38,
                        "end": 39
                      }
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 39
          }
        }
      },
      "span": {
        "start": 24,
        "end": 40
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
                  "start": 41,
                  "end": 43
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 46,
                                    "end": 47
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Int": 2
                                  },
                                  "span": {
                                    "start": 50,
                                    "end": 51
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 46,
                              "end": 51
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 54,
                              "end": 55
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 46,
                        "end": 55
                      }
                    },
                    "op": "Sub",
                    "right": {
                      "kind": {
                        "Int": 4
                      },
                      "span": {
                        "start": 58,
                        "end": 59
                      }
                    }
                  }
                },
                "span": {
                  "start": 46,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 41,
            "end": 59
          }
        }
      },
      "span": {
        "start": 41,
        "end": 60
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
                  "start": 61,
                  "end": 63
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 66,
                              "end": 67
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Int": 2
                                  },
                                  "span": {
                                    "start": 71,
                                    "end": 72
                                  }
                                },
                                "op": "Concat",
                                "right": {
                                  "kind": {
                                    "Int": 3
                                  },
                                  "span": {
                                    "start": 75,
                                    "end": 76
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 71,
                              "end": 76
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 66,
                        "end": 76
                      }
                    },
                    "op": "ShiftRight",
                    "right": {
                      "kind": {
                        "Int": 4
                      },
                      "span": {
                        "start": 80,
                        "end": 81
                      }
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 81
                }
              }
            }
          },
          "span": {
            "start": 61,
            "end": 81
          }
        }
      },
      "span": {
        "start": 61,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
  }
}
===ast >=8.0===
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 11,
                        "end": 14
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 21,
                              "end": 22
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 22
                      }
                    }
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 29,
                        "end": 30
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 33,
                              "end": 34
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 38,
                              "end": 39
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 39
                      }
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 39
          }
        }
      },
      "span": {
        "start": 24,
        "end": 40
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
                  "start": 41,
                  "end": 43
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 46,
                              "end": 47
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 50,
                              "end": 51
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 46,
                        "end": 51
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 54,
                              "end": 55
                            }
                          },
                          "op": "Sub",
                          "right": {
                            "kind": {
                              "Int": 4
                            },
                            "span": {
                              "start": 58,
                              "end": 59
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 54,
                        "end": 59
                      }
                    }
                  }
                },
                "span": {
                  "start": 46,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 41,
            "end": 59
          }
        }
      },
      "span": {
        "start": 41,
        "end": 60
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
                  "start": 61,
                  "end": 63
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 66,
                              "end": 67
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 71,
                              "end": 72
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 66,
                        "end": 72
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 75,
                              "end": 76
                            }
                          },
                          "op": "ShiftRight",
                          "right": {
                            "kind": {
                              "Int": 4
                            },
                            "span": {
                              "start": 80,
                              "end": 81
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 75,
                        "end": 81
                      }
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 81
                }
              }
            }
          },
          "span": {
            "start": 61,
            "end": 81
          }
        }
      },
      "span": {
        "start": 61,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
  }
}
