===source===
<?php
interface ReadWrite extends Readable, Writable {
    public function flush(): void;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "ReadWrite",
            "span": {
              "start": 16,
              "end": 25
            }
          },
          "extends": [
            {
              "parts": [
                "Readable"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 34,
                "end": 42
              }
            },
            {
              "parts": [
                "Writable"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 44,
                "end": 52
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "flush",
                    "span": {
                      "start": 75,
                      "end": 80
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 84,
                          "end": 88
                        }
                      }
                    },
                    "span": {
                      "start": 84,
                      "end": 88
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 59,
                "end": 89
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}
