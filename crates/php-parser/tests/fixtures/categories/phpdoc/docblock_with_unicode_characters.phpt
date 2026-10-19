===source===
<?php

/**
 * Service with Unicode docstring
 * Author: José García 🎉
 * Arrows: → ← ↑ ↓
 * Symbols: © ® ™ € ¥
 * @see https://example.com/service
 */
class ServiceWithUnicode {
    /**
     * Method with emojis 😀 😎 🚀
     * Accented: café, naïve, résumé
     */
    public function process() {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "ServiceWithUnicode",
            "span": {
              "start": 177,
              "end": 195
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
                    "name": "process",
                    "span": {
                      "start": 316,
                      "end": 323
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Method with emojis 😀 😎 🚀\n     * Accented: café, naïve, résumé\n     */",
                    "span": {
                      "start": 202,
                      "end": 295
                    }
                  }
                }
              },
              "span": {
                "start": 300,
                "end": 328
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * Service with Unicode docstring\n * Author: José García 🎉\n * Arrows: → ← ↑ ↓\n * Symbols: © ® ™ € ¥\n * @see https://example.com/service\n */",
            "span": {
              "start": 7,
              "end": 170
            }
          }
        }
      },
      "span": {
        "start": 171,
        "end": 330
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 330
  }
}
