===source===
<?php
namespace NAMEspace\xyz;
===errors===
expected namespace name, found namespace-relative name
===php_error===
PHP Parse error:  syntax error, unexpected namespace-relative name "NAMEspace\xyz", expecting "{" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "xyz"
            ],
            "kind": "Relative",
            "span": {
              "start": 16,
              "end": 29
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
